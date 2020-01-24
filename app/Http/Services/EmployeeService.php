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
     * @param array  $employeeDetails Array contains employee details
     * @param string $teamUuid        Team uuid
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
     * @param string $teamUuid     Team Uuid
     */
    public function assignEmployeeToTeam(string $employeeUuid, string $teamUuid)
    {
        $employee = Employee::query()->where('uuid', '=', $employeeUuid)->first();
        $team = Team::query()->where('uuid', '=', $teamUuid)->first();
        $employee->team()->save($team);
    }

    public function getEmployeeAccessableItem(string $employeeUuid)
    {
        $employee = Employee::query()->where('uuid', '=', $employeeUuid)->first();
        $accessUuid = $employee->access->uuid;
        $access = AccessLevel::query()->where('uuid', '=', $accessUuid)->first();
        $t = $access->items();
        var_dump($access);exit;
    }
}
