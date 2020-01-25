<?php


    namespace App\Http\Services;


    use App\Models\AccessLevel;
    use App\Models\Team;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Str;
    use Ramsey\Uuid\UuidInterface;

    class TeamService
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
         * Function responsible to create a team
         *
         * @param array $teamDetails Team data
         *
         * @return Builder|Model
         */
        public function createTeam(array $teamDetails)
        {
            $teamDetails['uuid'] = $this->uuid;
            return Team::query()->create($teamDetails);
        }

        /**
         * This function responsible to return all the item accessible by this team
         *
         * @param string $teamUuid Team Uuid
         *
         * @return mixed
         */
        public function getEmployeeAccessibleItemsByTeam(string $teamUuid)
        {
            $team = Team::query()->where('uuid', '=', $teamUuid)->first();
            $teamAccessUuid = $team->access->uuid;
            $access = AccessLevel::query()->where('uuid', '=', $teamAccessUuid)->first();
            return $access->items->toArray();
        }

        // TODO create a function to return the items through the folders, merge it together

        public function getAllTeams()
        {
            return Team::all()->toArray();
        }
    }
