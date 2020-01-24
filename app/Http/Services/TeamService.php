<?php


namespace App\Http\Services;


use App\Models\Team;
use Illuminate\Support\Str;

class TeamService
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
     * Function responsible to create a team
     *
     * @param array $teamDetails  Team data
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function createTeam(array $teamDetails)
    {
        $teamDetails['uuid'] = $this->uuid;
        return Team::query()->create($teamDetails);
    }
}
