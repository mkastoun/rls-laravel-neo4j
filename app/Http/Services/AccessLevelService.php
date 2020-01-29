<?php

namespace App\Http\Services;

use App\Models\AccessLevel;
use App\Models\Employee;
use App\Models\Folder;
use App\Models\Item;
use App\Models\Team;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Ramsey\Uuid\UuidInterface;

class AccessLevelService
{
    /**
     * @var UuidInterface
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
     * @return Builder|Model
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
     * @param  string  $teamUuid  Team uuid
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
     * @param  string  $teamUuid  Team uuid
     *
     * @return array
     */
    public function folderAccessLevel(string $teamUuid)
    {
        $team = Folder::query()->where('uuid', '=', $teamUuid)->first();
        return (!empty($team->access)) ? $team->access->toArray() : [];
    }

    /**
     * Get item access level
     *
     * @param  string  $teamUuid  Team uuid
     *
     * @return array
     */
    public function itemAccessLevel(string $teamUuid)
    {
        $team = Item::query()->where('uuid', '=', $teamUuid)->first();
        return (!empty($team->access)) ? $team->access->toArray() : [];
    }

    /**
     * Function responsible return access level list
     *
     * @return Builder|Model
     */
    public function access()
    {
        $access = AccessLevel::all();
        return (!empty($access)) ? $access->toArray() : [];
    }

    /**
     * Function responsible return access level list
     *
     * @return Builder|Model
     */
    public function accessDetails(string $accessUuid)
    {
        $access = AccessLevel::query()->where('uuid', '=', $accessUuid)->first();
        return (!empty($access)) ? $access->toArray() : [];
    }


    /**
     * Returns Employees without access level assigned
     *
     * @return array
     */
    public function employeeWithoutAccess()
    {
        $employees = Employee::all();
        $result = [];
        foreach ($employees as $employee) {
            if ($employee->access()->count() == 0) {
                $result[] = $employee->toArray();
            }
        }

        return $result;
    }

    /**
     * Returns Teams without access level assigned
     *
     * @return array
     */
    public function teamWithoutAccess()
    {
        $teams = Team::all();
        $result = [];
        foreach ($teams as $team) {
            if ($team->access()->count() == 0) {
                $result[] = $team->toArray();
            }
        }

        return $result;
    }

    /**
     * Returns Folders without access level assigned
     *
     * @return array
     */
    public function folderWithoutAccess()
    {
        $folders = Folder::all();
        $result = [];
        foreach ($folders as $folder) {
            if ($folder->access()->count() == 0) {
                $result[] = $folder->toArray();
            }
        }

        return $result;
    }

    /**
     * Returns items without access level assigned
     *
     * @return array
     */
    public function itemWithoutAccess()
    {
        $items = Item::all();
        $result = [];
        foreach ($items as $item) {
            if ($item->access()->count() == 0) {
                $result[] = $item->toArray();
            }
        }

        return $result;
    }

    /**
     * Revoke access from employee
     *
     * @param  string  $accessUuid    Access Uuid
     * @param  string  $employeeUuid  Employee Uuid
     */
    public function revokeEmployeeAccess(string $accessUuid, string $employeeUuid)
    {
        $employee = Employee::query()->where('uuid', '=', $employeeUuid)->first();
        $access = AccessLevel::query()->where('uuid', '=', $accessUuid)->first();
        $employee->access()->detach($access);
    }

    /**
     * Revoke access from team
     *
     * @param  string  $accessUuid  Access Uuid
     * @param  string  $teamUuid    Team Uuid
     */
    public function revokeTeamAccess(string $accessUuid, string $teamUuid)
    {
        $team = Team::query()->where('uuid', '=', $teamUuid)->first();
        $access = AccessLevel::query()->where('uuid', '=', $accessUuid)->first();
        $team->access()->detach($access);
    }

    /**
     * Revoke access from folder
     *
     * @param  string  $accessUuid  Access Uuid
     * @param  string  $folderUuid  Folder Uuid
     */
    public function revokeFolderAccess(string $accessUuid, string $folderUuid)
    {
        $folder = Folder::query()->where('uuid', '=', $folderUuid)->first();
        $access = AccessLevel::query()->where('uuid', '=', $accessUuid)->first();
        $folder->access()->detach($access);
    }

    /**
     * Revoke access from item
     *
     * @param  string  $accessUuid  Access Uuid
     * @param  string  $itemUuid    Item Uuid
     */
    public function revokeItemAccess(string $accessUuid, string $itemUuid)
    {
        $item = Item::query()->where('uuid', '=', $itemUuid)->first();
        $access = AccessLevel::query()->where('uuid', '=', $accessUuid)->first();
        $item->access()->detach($access);
    }

}
