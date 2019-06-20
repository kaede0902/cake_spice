# PHP workspace
## CakePHP3
I made cms, CRUD, tag, auth functioally App by  
[cakePHP tutorial](https://book.cakephp.org/3.0/en/tutorials-and-examples/cms/articles-controller.html)  
used 1.5 monthes. 

### Result
At least, this shows you that I can make basic CURD web app which has Tags and Auth functions following the tutorial.  

### codes
``` Auth
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
                .'  This article is written by user:  '.$article->user_id);
        }
        return $isEditable;
    }
```
