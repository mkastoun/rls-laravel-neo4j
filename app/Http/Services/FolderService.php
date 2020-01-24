<?php


namespace App\Http\Services;


use App\Models\Folder;
use App\Models\Item;
use App\Models\Team;
use Illuminate\Support\Str;

class FolderService
{
    /**
     * @var \Ramsey\Uuid\UuidInterface
     */
    protected $uuid;

    /**
     * TeamService constructor.
     */
    public function __construct()
    {
        $this->uuid = Str::uuid();
    }

    /**
     * Function responsible to create a folder
     *
     * @param array $teamDetails  Team data
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function createFolder(array $teamDetails)
    {
        $teamDetails['uuid'] = $this->uuid;
        return Folder::query()->create($teamDetails);
    }

}
