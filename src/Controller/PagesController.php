<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\View\Exception\MissingTemplateException;

/**
 * Pages Controller
 *
 * This controller handles static content and provides data for the custom home page.
 */
class PagesController extends AppController
{
    /**
     * Displays a view
     *
     * @param string ...$path Path segments.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Http\Exception\ForbiddenException
     * @throws \Cake\Http\Exception\NotFoundException
     */
    public function display(string ...$path): ?Response
    {
        if (!$path) {
            return $this->redirect('/');
        }
        if (in_array('..', $path, true) || in_array('.', $path, true)) {
            throw new ForbiddenException();
        }

        $page = $subpage = null;
        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }

        /**
         * CUSTOM DATA FOR AIRPAZ HOMEPAGE
         * These specific values match the text in the provided image.
         */
        if ($page === 'home') {
            $recommendations = [
                ['city' => 'Kuala Lumpur', 'price' => '58.73', 'from' => 'Kota Bharu'],
                ['city' => 'Kuching', 'price' => '69.00', 'from' => 'Bintulu'],
                ['city' => 'Kota Kinabalu', 'price' => '58.00', 'from' => 'Sandakan'],
                ['city' => 'Penang', 'price' => '58.73', 'from' => 'Langkawi'],
                ['city' => 'Johor Bahru', 'price' => '58.73', 'from' => 'Kuala Lumpur'],
                ['city' => 'Tawau', 'price' => '65.00', 'from' => 'Kota Kinabalu'],
                ['city' => 'Sibu', 'price' => '68.16', 'from' => 'Kuala Lumpur'],
                ['city' => 'Langkawi', 'price' => '58.73', 'from' => 'Penang'],
            ];
            
            // content of PagesController::display()
            $airportsTable = $this->fetchTable('Airports');
            $airports = $airportsTable->find('list', [
                'keyField' => 'id',
                'valueField' => function ($airport) {
                    return $airport->city . ' (' . $airport->airport_code . ')';
                }
            ])->all()->toArray();

            $this->set(compact('recommendations', 'airports'));
        }

        $this->set(compact('page', 'subpage'));

        try {
            return $this->render(implode('/', $path));
        } catch (MissingTemplateException $exception) {
            if (Configure::read('debug')) {
                throw $exception;
            }
            throw new NotFoundException();
        }
    }
}