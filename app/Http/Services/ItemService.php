<?php

namespace App\Http\Services;

use App\Models\Folder;
use App\Models\Item;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Ramsey\Uuid\UuidInterface;

class ItemService
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
     * Function responsible to create an item
     *
     * @param  array   $itemDetails  Item data
     * @param  string  $folderUuid   Folder uuid
     *
     * @return Builder|Model
     */
    public function createItem(array $itemDetails, string $folderUuid)
    {
        $itemDetails['uuid'] = $this->uuid;
        $item = Item::query()->create($itemDetails);
        $this->assignItemToFolder($this->uuid, $folderUuid);
        return $item;
    }

    /**
     * Function responsible to assign an item to a folder
     *
     * @param  string  $itemUuid    Item uuid
     * @param  string  $folderUuid  Folder uuid
     */
    public function assignItemToFolder(string $itemUuid, string $folderUuid)
    {
        $item = Item::query()->where('uuid', '=', $itemUuid)->first();
        $folder = Folder::query()->where('uuid', '=', $folderUuid)->first();
        $folder->items()->save($item);
    }

    /**
     * @param  string  $folderUuid
     *
     * @return array|mixed
     */
    public function getFolderItems(string $folderUuid)
    {
        $folderService = new FolderService();
        return $folderService->items($folderUuid);
    }

    public function itemDetails($itemUuid)
    {
        $item = Item::query()->where('uuid', '=', $itemUuid)->first();
        return (!empty($item)) ? $item->toArray() : [];
    }
}
