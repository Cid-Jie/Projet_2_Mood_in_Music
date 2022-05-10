<?php

namespace App\Controller;

use DateTime;
use DateInterval;
use App\Model\VoteManager;
use App\Controller\AbstractController;
use App\Model\MusicManager;

class VoteController extends AbstractController
{
    /**
     * Displays home page
     */
    public function index(): ?string
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /");
            return null;
        }
        $voteManager = new VoteManager();
        $dates = $voteManager->selectAllDates();
        $currentDate = new DateTime('now');
        $currentDate = $currentDate->format('Y-m-d H:i:s');

        return $this->twig->render('Admin/vote.html.twig', ['dates' => $dates , 'currentDate' => $currentDate]);
    }

    /**
     * Initializes the start_date of votes
     */
    public function launchVote()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /");
            return null;
        }
        //getting the time of the click
        $startDate = new DateTime('now');
        //calculation of the end_date
        $voteInterval = new DateInterval('P7D');
        $endDate = $startDate->add($voteInterval);
        //changing dates into strings
        $startDate = new DateTime('now');
        $startDate = $startDate->format('Y-m-d H:i:s');
        $endDate = $endDate->format('Y-m-d H:i:s');
        //setting the managers to access DB
        $voteManager = new VoteManager();
        $musicManager = new MusicManager();
        //inserting dates and update votes in DB
        $voteManager->insert($startDate, $endDate);
        $musicManager->movesVotesInDB();

        header("Location: /admin/vote");
    }

    public function showVote(int $genreId = null)
    {
        $voteManager = new VoteManager();
        $votes = $voteManager->selectVoteById($genreId);
        $allSelected = false;
        if ($genreId == null) {
            $allSelected = true;
        }

        return $this->twig->render('Music/showVote.html.twig', ['votes' => $votes, 'allSelected' => $allSelected]);
    }

    public function addVote(int $id)
    {
        $voteManager = new VoteManager();
        $voteMusic = $voteManager->selectOneById($id);
        $voteManager->incrementVote($voteMusic);
        setcookie('hasVoted', 'true', (time() + 300), '/');
        header("Location: /");
        return null;
    }
}
