<?php
namespace App\Controller;
use App\Controller\AppController;

class ArticlesController extends AppController
{

    public function initialize() {
        parent::initialize();

        $this->Auth->allow(['tags']);
            
        $this->loadComponent('Paginator');
        $this->loadComponent('Flash'); // Include the FlashComponent
    }

    public function index()
    {
        $articles = $this->Paginator->paginate($this->Articles->find());
        $this->set('test','testresult');
        $printUser = $this->Auth->user('id');
        $this->set(compact('articles','printUser'));
    }


    public function view($slug)
    {
        $article = $this->Articles
            ->findBySlug($slug)
            ->contain(['Tags'])
            ->firstOrFail();
        $this->set(compact('article'));
    }

    public function add()
    {
        $article = $this->Articles->newEntity();
        #debug($this->Flash);
        if ($this->request->is('post')) {
            $article = $this->Articles->patchEntity($article, $this->request->getData());

            $article->user_id = $this->Auth->user('id');

            if ($this->Articles->save($article)) {
                $this->Flash->success(__('Your article has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add your article.'));
        }
        #$tags = $this->Articles->Tags->find('list');
        #$this->set('tags', $tags);
        $this->set('article', $article);
    }


    public function edit($slug) {
        $article = $this->Articles
            ->findBySlug($slug)
            ->contain('Tags')
            ->firstOrFail();
        if ($this->request->is(['post', 'put'])) {
            $this->Articles->patchEntity(
                $article,
                $this->request->getData(),
                ['accessibleFields' => ['user_id' => false]]
            );
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('Your article has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update your article.'));
        }
#        $tags = $this->Articles->Tags->find('list');

        #$this->set('tags', $tags);
        $this->set('article', $article);
    }
    public function tags()
    {
    // The 'pass' key is provided by CakePHP and contains all
       // the passed URL path segments in the request.
        $tags = $this->request->getParam('pass');
        // Use the ArticlesTable to find tagged articles.
        $articles = $this->Articles->find('tagged', [
            'tags' => $tags
        ]);

        // Pass variables into the view template context.
        $this->set([
            'articles' => $articles,
            'tags' => $tags
        ]);
    }

    public function isAuthorized($user) {
        $action = $this->request->getParam('action');
        if (in_array($action, ['add','tags'])) {
            return true;
        }
        $slug = $this->request->getParam('pass.0');
        if (!$slug) {
            return false;
        }
        $article = $this->Articles->findBySlug($slug)->first();
        $isEditable = $article->user_id === $user['id'];
        $auther = $article->user_id; $user_now = $user['id'];
        if (!$isEditable) {
            $this->Flash->error(
                'You did not write this, user:  '.$user_now
                .'  This article is written by user:  '.$author);
        }
        return $isEditable;
    }
    

}

