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

    /**
     * Funtion responsible to return all the folders
     *
     * @return Folder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function folders()
    {
        return Folder::all();
    }

    public function folderDetails($folderUuid)
    {
        $folder = Folder::query()->where('uuid', '=', $folderUuid)->first();
        return (!empty($folder)) ? $folder->toArray() : [];
    }

    public function items($folderUuid)
    {
        $folder = Folder::query()->where('uuid', '=', $folderUuid)->first();
        return (!empty($folder)) ? $folder->items->toArray() : [];
    }

}
