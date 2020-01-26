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

        public function teamDetails(string $teamUuid)
        {
            $team = Team::query()->where('uuid', '=', $teamUuid)->first();
            return (!empty($team)) ? $team->toArray() : [];
        }

        public function teamEmployee(string $teamUuid)
        {
            $team = Team::query()->where('uuid', '=', $teamUuid)->first();
            return $team->employees->toArray();
        }

        /**
         * Get list of accessible folder for a specific team
         *
         * @param string $teamUuid  Team uuid
         *
         * @return mixed
         */
        public function getTeamAccessibleFolders(string $teamUuid)
        {
            $team = Team::query()->where('uuid', '=', $teamUuid)->first();
            $teamAccessUuid = $team->access->uuid;
            $access = AccessLevel::query()->where('uuid', '=', $teamAccessUuid)->first();
            return (!empty($access->folders)) ? $access->folders->toArray() : [];
        }

        /**
         * Get list of accessible items for a specific team
         *
         * @param string $teamUuid  Team uuid
         *
         * @return mixed
         */
        public function getTeamAccessibleItems(string $teamUuid)
        {
            $team = Team::query()->where('uuid', '=', $teamUuid)->first();
            $teamAccessUuid = $team->access->uuid;
            $access = AccessLevel::query()->where('uuid', '=', $teamAccessUuid)->first();
            return (!empty($access->items)) ? $access->items->toArray() : [];
        }

    }
