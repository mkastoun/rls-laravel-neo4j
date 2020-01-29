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

    public function getEmployee(string $employeeUuid)
    {
        $employee = Employee::query()->where('uuid', '=', $employeeUuid)->first();
        return $employee->toArray();
    }

    /**
     * Function responsible to create an employee
     *
     * @param  array   $employeeDetails  Array contains employee details
     * @param  string  $teamUuid         Team uuid
     * @param  bool    $isOrphan         Orphan flag to skip the employee team link
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
     * @param  string  $employeeUuid  Employee Uuid
     * @param  string  $teamUuid      Team Uuid
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
     * @param  string  $employeeUuid  Employee uuid
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

    /**
     * Get list of items accessible by an employee
     *
     * @param  string  $employeeUuid  Employee uuid
     *
     * @return array
     */
    public function employeeItems(string $employeeUuid)
    {
        $employee = Employee::query()->where('uuid', '=', $employeeUuid)->first();
        if (empty($employee->access)) {
            return [];
        }
        $employeeAccessUuid = $employee->access->uuid;
        $access = AccessLevel::query()->where('uuid', '=', $employeeAccessUuid)->first();
        return (!empty($access->items)) ? $access->items->toArray() : [];
    }

    /**
     * Get team of the employee that belongs to
     *
     * @param  string  $employeeUuid
     *
     * @return array
     */
    public function teamOfEmployee(string $employeeUuid)
    {
        $employee = Employee::query()->where('uuid', '=', $employeeUuid)->first();
        if (empty($employee->team)) {
            return [];
        }
        $teamUuid = $employee->team->uuid;
        $team = Team::query()->where('uuid', '=', $teamUuid)->first();
        return $team->toArray();
    }

    /**
     * Get employee access level
     *
     * @param  string  $employeeUuid  Employee uuid
     *
     * @return array
     */
    public function employeeAccessLevel(string $employeeUuid)
    {
        $employee = Employee::query()->where('uuid', '=', $employeeUuid)->first();
        return (!empty($employee->access)) ? $employee->access->toArray() : [];
    }

    /**
     * Get list of accessible folder for a specific employee
     *
     * @param  string  $teamUuid  Team uuid
     *
     * @return mixed
     */
    public function getEmployeeAccessibleFolders(string $teamUuid)
    {
        $employee = Employee::query()->where('uuid', '=', $teamUuid)->first();
        if (empty($employee->access)) {
            return [];
        }
        $teamAccessUuid = $employee->access->uuid;
        $access = AccessLevel::query()->where('uuid', '=', $teamAccessUuid)->first();
        return (!empty($access->folders)) ? $access->folders->toArray() : [];
    }

    /**
     * Get the items accessible by employee's team
     *
     * @param  string  $employeeUuid
     *
     * @return array
     */
    public function teamEmployeeItems(string $employeeUuid)
    {
        $employee = Employee::query()->where('uuid', '=', $employeeUuid)->first();
        if (empty($employee->team)) {
            return [];
        }
        $teamUuid = $employee->team->uuid;
        $team = Team::query()->where('uuid', '=', $teamUuid)->first();
        if (empty($team->access)) {
            return [];
        }
        $teamAccessUuid = $team->access->uuid;
        $access = AccessLevel::query()->where('uuid', '=', $teamAccessUuid)->first();
        return (!empty($access->items)) ? $access->items->toArray() : [];
    }

    /**
     * Get the Folders accessible by employee's team
     *
     * @param  string  $employeeUuid
     *
     * @return array
     */
    public function teamEmployeeFolders(string $employeeUuid)
    {
        $employee = Employee::query()->where('uuid', '=', $employeeUuid)->first();
        if (empty($employee->team)) {
            return [];
        }
        $teamUuid = $employee->team->uuid;
        $team = Team::query()->where('uuid', '=', $teamUuid)->first();
        if (empty($team->access)) {
            return [];
        }
        $teamAccessUuid = $team->access->uuid;
        $access = AccessLevel::query()->where('uuid', '=', $teamAccessUuid)->first();
        return (!empty($access->folders)) ? $access->folders->toArray() : [];
    }

    /**
     * Returns Employees without Team
     *
     * @return array
     */
    public function getOrphanEmployee()
    {
        $employees = Employee::all();
        $result = [];
        foreach ($employees as $employee) {
            if ($employee->team()->count() == 0) {
                $result[] = $employee->toArray();
            }
        }
        return $result;
    }
}
