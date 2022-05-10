<?php

namespace App\Controller;

use App\Model\MusicManager;
use App\Model\VoteManager;
use App\Service\MusicService;
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
        if (isset($_COOKIE['hasVoted'])) {
            $hasVoted = $_COOKIE['hasVoted'];
        } else {
            $hasVoted = false;
        }
        return $this->twig->render(
            'Home/listAll.html.twig',
            ['musics' => $musics,
             'hasVoted' => $hasVoted,
             'dates' => $dates]
        );
    }

    public function index(): ?string
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /");
            return null;
        }
        $musicManager = new MusicManager();
        $musics = $musicManager->selectAllList();

        return $this->twig->render('Admin/index.html.twig', ['musics' => $musics]);
    }

    public function show(int $id): ?string
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /");
            return null;
        }
        $musicManager = new MusicManager();
        $music = $musicManager->selectOneById($id);

        return $this->twig->render('Admin/show.html.twig', ['music' => $music]);
    }

    public function edit(int $id): ?string
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /");
            return null;
        }
        $musicManager = new MusicManager();
        $genres = $musicManager->selectAllGenre();

        $musicManager = new MusicManager();
        $music = $musicManager->selectOneById($id);

        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $music = array_map('trim', $_POST);

            $musicService = new MusicService();
            $errors = $musicService->checkFields($music);

            // if validation is ok, update and redirection
            if (empty($errors)) {
                $musicManager->update($music);

                header('Location: /admin/show?id=' . $id);
                return null;
            }
        }

        $musicManager = new MusicManager();
        $music = $musicManager->selectOneById($id);
        return $this->twig->render('Admin/edit.html.twig', [
            'music' => $music,
            'genres' => $genres,
            'errors' => $errors
        ]);
    }

    public function add(): ?string
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /");
            return null;
        }
        $musicManager = new MusicManager();
        $genres = $musicManager->selectAllGenre();

        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $music = array_map('trim', $_POST);

            $musicService = new MusicService();
            $errors = $musicService->checkFields($music);

            // if validation is ok, insert and redirection
            if (empty($errors)) {
                $musicManager = new MusicManager();
                $id = $musicManager->insert($music);

                header('Location:/admin/show?id=' . $id);
                return null;
            }
        }

        return $this->twig->render('Admin/add.html.twig', ['genres' => $genres, 'errors' => $errors]);
    }

    public function delete()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /");
            return null;
        }
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
