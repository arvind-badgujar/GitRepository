<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Github\Client;

/**
 * Class GitController
 * @package CR\LegacyApiBundle\Controller
 *  Get all the Symfony repositories hosted on GitHub.
 *  Html Response
 */
class GitController extends Controller
{
    public function getRepositories()
    {
        $client = new Client();
        $repositories = $client->api('users')->repositories('symfony');
        $repositoryDetails = [];

        foreach ($repositories as $repository ) {
            $repositoryList = [];
            $repositoryList['Id'] = $repository['id'];
            $repositoryList['Name'] = $repository['name'];
            $repositoryList['FullName'] = $repository['full_name'];
            $repositoryList['Url'] = $repository['html_url'];
            $repositoryList['Description'] = $repository['description'];
            $repositoryDetails['Repositories'][] = $repositoryList;
        }

        return $this->render('repositoryDetails.html.twig',[
            'repositoryDetails' => $repositoryDetails
            ]);
    }
}