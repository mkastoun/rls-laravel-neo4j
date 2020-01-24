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

    public function createAccessLevel(array $accessLevelDetails)
    {
        $accessLevelDetails['uuid'] = $this->uuid;
        return AccessLevel::query()->create($accessLevelDetails);
    }

    public function assignAccessToEmployee(string $accessUuid, string $employeeUuid)
    {
        $employee = Employee::query()->where('uuid', '=', $employeeUuid)->first();
        $accessLevel = AccessLevel::query()->where('uuid', '=', $accessUuid)->first();
        $employee->access()->save($accessLevel);
    }

    public function assignAccessToItem(string $accessUuid, string $itemUuid)
    {
        $item = Item::query()->where('uuid', '=', $itemUuid)->first();
        $accessLevel = AccessLevel::query()->where('uuid', '=', $accessUuid)->first();
        $item->access()->save($accessLevel);
    }

    public function assignAccessToFolder(string $accessUuid, string $folderUuid)
    {
        $folder = Folder::query()->where('uuid', '=', $folderUuid)->first();
        $accessLevel = AccessLevel::query()->where('uuid', '=', $accessUuid)->first();
        $folder->access()->save($accessLevel);
    }

    public function assignAccessToTeam(string $accessUuid, string $teamUuid)
    {
        $team = Team::query()->where('uuid', '=', $teamUuid)->first();
        $accessLevel = AccessLevel::query()->where('uuid', '=', $accessUuid)->first();
        $team->access()->save($accessLevel);
    }
}
