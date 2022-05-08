<?php

namespace App\Controller;

use App\Model\MusicManager;
use App\Model\VoteManager;
use DateTime;

class MusicController extends AbstractController
{
    /**
     * List musics
     */
    public function showListAll()
    {
        $musicManager = new MusicManager();
        $musics = $musicManager->selectAllList();
        $voteManager = new VoteManager();
        $dates = $voteManager->selectAllDates();
        $currentDate = new DateTime('now');
        //$currentDate->format('Y-m-d H:i:s');
        if (isset($_COOKIE['hasVoted'])) {
            $hasVoted = $_COOKIE['hasVoted'];
        } else {
            $hasVoted = false;
        }
        return $this->twig->render(
            'Home/listAll.html.twig',
            ['musics' => $musics,
             'hasVoted' => $hasVoted,
             'currentDate' => $currentDate,
             'dates' => $dates]
        );
    }

    public function index(): string
    {
        $musicManager = new MusicManager();
        $musics = $musicManager->selectAllList();

        return $this->twig->render('Admin/index.html.twig', ['musics' => $musics]);
    }

    public function show(int $id): string
    {
        $musicManager = new MusicManager();
        $music = $musicManager->selectOneById($id);

        return $this->twig->render('Admin/show.html.twig', ['music' => $music]);
    }

    public function edit(int $id): ?string
    {
        $musicManager = new MusicManager();
        $genres = $musicManager->selectAllGenre();

        $musicManager = new MusicManager();
        $music = $musicManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $music = array_map('trim', $_POST);

            // if validation is ok, update and redirection
            $musicManager->update($music);

            header('Location: /admin/show?id=' . $id);

            return null;
        }

        $musicManager = new MusicManager();
        $music = $musicManager->selectOneById($id);
        return $this->twig->render('Admin/edit.html.twig', [
            'music' => $music,
            'genres' => $genres
        ]);
    }

    public function add(): ?string
    {
        $musicManager = new MusicManager();
        $genres = $musicManager->selectAllGenre();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $music = array_map('trim', $_POST);

            // if validation is ok, insert and redirection
            $musicManager = new MusicManager();
            $id = $musicManager->insert($music);

            header('Location:/admin/show?id=' . $id);
            return null;
        }

        return $this->twig->render('Admin/add.html.twig', ['genres' => $genres]);
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && is_numeric($_GET['id'])) {
            $id = trim($_GET['id']);
            $musicManager = new MusicManager();
            $musicManager->delete((int)$id);
            $message = "La musique a bien été supprimée !";

            return $this->twig->render('Admin/confirmdelete.html.twig', ['message' => $message]);
        } elseif (!is_numeric($_GET['id'])) {
            echo "Id non valide";
        }
    }

    public function player(int $id)
    {
        $musicManager =  new MusicManager();
        $player = $musicManager->selectOneById($id);

        return $this->twig->render('Music/player.html.twig', ['player' => $player]);
    }
}
