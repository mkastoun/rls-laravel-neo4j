<?php

namespace App\Http\Services;

use App\Models\AccessLevel;
use App\Models\Employee;
use App\Models\Folder;
use App\Models\Item;
use App\Models\Team;
use Illuminate\Support\Str;

class AccessLevelService
{
    /**
     * @var \Ramsey\Uuid\UuidInterface
     */
    protected $uuid;

    /**
     * AccessLevelService constructor.
     */
    public function __construct()
    {
        $this->uuid = Str::uuid();
    }

    /**
     * Function responsible to create new access
     *
     * @param  array  $accessLevelDetails  Access details
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function createAccessLevel(array $accessLevelDetails)
    {
        $accessLevelDetails['uuid'] = $this->uuid;
        return AccessLevel::query()->create($accessLevelDetails);
    }

    /**
     * Assign employee to an access
     *
     * @param  string  $accessUuid    Access Uuid
     * @param  string  $employeeUuid  Employee Uuid
     */
    public function assignAccessToEmployee(string $accessUuid, string $employeeUuid)
    {
        $employee = Employee::query()->where('uuid', '=', $employeeUuid)->first();
        $accessLevel = AccessLevel::query()->where('uuid', '=', $accessUuid)->first();
        $employee->access()->save($accessLevel);
    }

    /**
     * Assign item to an access
     *
     * @param  string  $accessUuid  Access Uuid
     * @param  string  $itemUuid    Item Uuid
     */
    public function assignAccessToItem(string $accessUuid, string $itemUuid)
    {
        $item = Item::query()->where('uuid', '=', $itemUuid)->first();
        $accessLevel = AccessLevel::query()->where('uuid', '=', $accessUuid)->first();
        $item->access()->save($accessLevel);
    }

    /**
     * Assign folder to access
     *
     * @param  string  $accessUuid  Access Uuid
     * @param  string  $folderUuid  Folder Uuid
     */
    public function assignAccessToFolder(string $accessUuid, string $folderUuid)
    {
        $folder = Folder::query()->where('uuid', '=', $folderUuid)->first();
        $accessLevel = AccessLevel::query()->where('uuid', '=', $accessUuid)->first();
        $folder->access()->save($accessLevel);
    }

    /**
     * Assign team to access
     *
     * @param  string  $accessUuid  Access Uuid
     * @param  string  $teamUuid    Team Uuid
     */
    public function assignAccessToTeam(string $accessUuid, string $teamUuid)
    {
        $team = Team::query()->where('uuid', '=', $teamUuid)->first();
        $accessLevel = AccessLevel::query()->where('uuid', '=', $accessUuid)->first();
        $team->access()->save($accessLevel);
    }

    /**
     * Get team access level
     *
     * @param string $teamUuid  Team uuid
     *
     * @return array
     */
    public function teamAccessLevel(string $teamUuid)
    {
        $team = Team::query()->where('uuid', '=', $teamUuid)->first();
        return (!empty($team->access)) ? $team->access->toArray() : [];
    }

    /**
     * Get folder access level
     *
     * @param string $teamUuid  Team uuid
     *
     * @return array
     */
    public function folderAccessLevel(string $teamUuid)
    {
        $team = Folder::query()->where('uuid', '=', $teamUuid)->first();
        return (!empty($team->access)) ? $team->access->toArray() : [];
    }

    /**
     * Function responsible return access level list
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function access()
    {
        $access = AccessLevel::all();
        return (!empty($access)) ? $access->toArray() : [];
    }

    /**
     * Function responsible return access level list
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function accessDetails(string $accessUuid)
    {
        $access = AccessLevel::query()->where('uuid', '=', $accessUuid)->first();
        return (!empty($access)) ? $access->toArray() : [];
    }

    public function employeeWithoutAccess()
    {
        $employees = Employee::all();
        $result = [];
        foreach ($employees as $employee)
        {
            if ($employee->access()->count() == 0) {
                $result[] = $employee->toArray();
            }
        }

        return $result;
    }

    public function teamWithoutAccess()
    {
        $teams = Team::all();
        $result = [];
        foreach ($teams as $team)
        {
            if ($team->access()->count() == 0) {
                $result[] = $team->toArray();
            }
        }

        return $result;
    }

}
