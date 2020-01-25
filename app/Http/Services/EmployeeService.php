<?php


namespace App\Http\Services;


use App\Models\AccessLevel;
use App\Models\Employee;
use App\Models\Item;
use App\Models\Team;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class EmployeeService
{
    /**
     * @var \Ramsey\Uuid\UuidInterface
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
     * @param array $employeeDetails Array contains employee details
     * @param string $teamUuid Team uuid
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function createEmployee(array $employeeDetails, string $teamUuid)
    {
        $employeeDetails['uuid'] = $this->uuid;
        $employee = Employee::query()->create($employeeDetails);
        $this->assignEmployeeToTeam($this->uuid, $teamUuid);
        return $employee;
    }

    /**
     * Function responsible to assign an Employee to a Team
     *
     * @param string $employeeUuid Employee Uuid
     * @param string $teamUuid Team Uuid
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
        $employee = Employee::query()->where('uuid', '=', $employeeUuid)->first();
        $teamUuid = $employee->team->uuid;
        $employeeAccessUuid = $employee->access->uuid;
        $access = AccessLevel::query()->where('uuid', '=', $employeeAccessUuid)->first();
        $teamService = new TeamService();
        $result['teamItems'] = (!empty($teamUuid))
            ? $teamService->getEmployeeAccessibleItemsByTeam($teamUuid)
            : [];
        $result['employeeItems'] = $access->items->toArray();
        return $result;
    }
}
