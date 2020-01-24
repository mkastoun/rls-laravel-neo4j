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
}
