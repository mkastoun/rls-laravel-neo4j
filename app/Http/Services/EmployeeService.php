<?php


    namespace App\Http\Services;


    use App\Models\AccessLevel;
    use App\Models\Employee;
    use App\Models\Item;
    use App\Models\Team;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\Log;
    use Illuminate\Support\Str;
    use Ramsey\Uuid\UuidInterface;

    class EmployeeService
    {
        /**
         * @var UuidInterface
         */
        protected $uuid;

        /**
         * EmployeeService constructor.
         */
        public function __construct()
        {
            $this->uuid = Str::uuid();
        }

        /**
         * Function responsible to create an employee
         *
         * @param array  $employeeDetails Array contains employee details
         * @param string $teamUuid        Team uuid
         * @param bool   $isOrphan        Orphan flag to skip the employee team link
         *
         * @return Builder|Model
         */
        public function createEmployee(array $employeeDetails, string $teamUuid = null, bool $isOrphan = false)
        {
            $employeeDetails['uuid'] = $this->uuid;
            $employee = Employee::query()->create($employeeDetails);
            if (!$isOrphan) {
                $this->assignEmployeeToTeam($this->uuid, $teamUuid);
            }
            return $employee;
        }

        /**
         * Function responsible to assign an Employee to a Team
         *
         * @param string $employeeUuid Employee Uuid
         * @param string $teamUuid     Team Uuid
         */
        public function assignEmployeeToTeam(string $employeeUuid, string $teamUuid)
        {
            $employee = Employee::query()->where('uuid', '=', $employeeUuid)->first();
            $team = Team::query()->where('uuid', '=', $teamUuid)->first();
            $employee->team()->save($team);
        }

        /**
         * Get items related to he employees access level
         *
         * @param string $employeeUuid Employee uuid
         *
         * @return mixed
         */
        public function getEmployeeAccessibleItem(string $employeeUuid)
        {
            $teamService = new TeamService();
            $result['teamItems'] = (!empty($teamUuid))
                ? $teamService->getEmployeeAccessibleItemsByTeam($teamUuid)
                : [];
            $result['employeeItems'] = $this->employeeItems($employeeUuid);
            return $result;
        }

        public function teamOfEmployee(string $employeeUuid)
        {
            $employee = Employee::query()->where('uuid', '=', $employeeUuid)->first();
            $teamUuid = $employee->team->uuid;
            $team = Team::query()->where('uuid', '=', $teamUuid)->first();
            return $team->toArray();
        }

        /**
         * Get team access level
         *
         * @param string $teamUuid  Team uuid
         *
         * @return array
         */
        public function employeeAccessLevel(string $teamUuid)
        {
            $employee = Employee::query()->where('uuid', '=', $teamUuid)->first();
            return (!empty($employee->access)) ? $employee->access->toArray() : [];
        }

        /**
         * Get list of accessible folder for a specific team
         *
         * @param string $teamUuid  Team uuid
         *
         * @return mixed
         */
        public function getEmployeeAccessibleFolders(string $teamUuid)
        {
            $employee = Employee::query()->where('uuid', '=', $teamUuid)->first();
            $teamAccessUuid = $employee->access->uuid;
            $access = AccessLevel::query()->where('uuid', '=', $teamAccessUuid)->first();
            return (!empty($access->folders)) ? $access->folders->toArray() : [];
        }

        public function employeeItems(string $employeeUuid)
        {
            $employee = Employee::query()->where('uuid', '=', $employeeUuid)->first();
            $employeeAccessUuid = $employee->access->uuid;
            $access = AccessLevel::query()->where('uuid', '=', $employeeAccessUuid)->first();
            return (!empty($access->items)) ? $access->items->toArray() : [];
        }
    }
