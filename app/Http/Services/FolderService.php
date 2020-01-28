<?php

namespace App\Http\Services;

use App\Models\Folder;
use App\Models\Item;
use App\Models\Team;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Ramsey\Uuid\UuidInterface;

class FolderService
{
    /**
     * @var UuidInterface
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
     * @param  array  $teamDetails  Team data
     *
     * @return Builder|Model
     */
    public function createFolder(array $teamDetails)
    {
        $teamDetails['uuid'] = $this->uuid;
        return Folder::query()->create($teamDetails);
    }

    /**
     * Funtion responsible to return all the folders
     *
     * @return Folder[]|Collection
     */
    public function folders()
    {
        return Folder::all();
    }

    /**
     * Get Folder details
     *
     * @param  string  $folderUuid  Folder Uuid
     *
     * @return array
     */
    public function folderDetails(string $folderUuid)
    {
        $folder = Folder::query()->where('uuid', '=', $folderUuid)->first();
        return (!empty($folder)) ? $folder->toArray() : [];
    }

    /**
     * Get Folder Items
     *
     * @param  string  $folderUuid
     *
     * @return array
     */
    public function items(string $folderUuid)
    {
        $folder = Folder::query()->where('uuid', '=', $folderUuid)->first();
        return (!empty($folder)) ? $folder->items->toArray() : [];
    }

}
