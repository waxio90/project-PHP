<?php

declare(strict_types=1);

namespace App\Controller;

class AccountController extends AbstractController
{
    public function listUserAdAction(): void
    {
        if ($this->isSession()) {
           $listAd = $this->database->listUserAd($_SESSION['id']);
        }
        
        $this->view->render('listUserAd', [
            'listAd' => $listAd,
            'before' => $this->request->getParam('before'),
            'error' => $this->request->getParam('error')
        ]);
    }
    
    public function listUserAppAction(): void
    {
        if ($this->isSession()) {
            $listApp = $this->database->listUserApp($_SESSION['id']);
        }
        
        $this->view->render('listUserApp', [
            'app' => $listApp,
            'error' => $this->request->getParam('error'),
            'before' => $this->request->getParam('before')
        ]);
    }
    
    public function settingsUserAction(): void
    {
        if ($this->isSession()) {
            $this->changePassword();
        }
        
        $this->view->render('settingsUser',[
            'error' => $this->request->getParam('error'),
            'before' => $this->request->getParam('before')
        ]);
    }
    
    public function deleteUserAction(): void
    {
        if ($this->isSession()) {
            $this->deleteUser(); 
        }
        
        $this->view->render('deleteUser');
    }
    
    public function editAdAction(): void
    {
        if ($this->isSession()) {
            if ($this->request->hasPost()) {
                $idAd = (int) $this->request->postParam('id');
                $adData = [
                    'company' => $this->request->postParam('company'),
                    'locationCompany' => $this->request->postParam('locationCompany'),
                    'descriptionCompany' => $this->request->postParam('descriptionCompany'),
                    'title' => $this->request->postParam('title'),
                    'position' => $this->request->postParam('position'),
                    'level' => $this->request->postParam('level'),
                    'contract' => $this->request->postParam('contract'),
                    'locationJob' => $this->request->postParam('locationJob'),
                    'salaryFrom' => $this->request->postParam('salaryFrom'),
                    'salaryTo' => $this->request->postParam('salaryTo'),
                    'salary' => $this->request->postParam('salary'),
                    'currency' => $this->request->postParam('currency'),
                    'descriptionNeeds' => $this->request->postParam('descriptionNeeds')
                ];
                
                if (empty($adData['company']) || empty($adData['locationCompany']) || empty($adData['title']) || empty($adData['position'])
                    || empty($adData['descriptionNeeds'])) {
                        $this->redirect('/?action=edit', ['error' => 'emptyData']);
                    }
                    
                    if (!preg_match('/^[a-zA-Zęóąśłżźń]|[a-zA-Zęóąśłżźń]+\s[a-zA-Zęóąśłżźń]{4,30}$/', $adData['locationCompany'])) {
                        $this->redirect('/?action=edit', ['error' => 'locationCompany']);
                    }
                    
                    $this->database->editAd($adData, (int) $idAd, (int) $_SESSION['id']);
                    $this->redirect('/?action=listUserAd', ['before' => 'update']);
            }
        }
        
        $this->view->render('editAd', ['ad' => $this->getAdUser()]);
    }
    
    public function deleteAdAction(): void
    {
        if ($this->isSession()) {
            if ($this->request->hasPost()) {
                $id = $this->request->postParam('id');
                $this->database->deleteAd((int) $id, (int) $_SESSION['id']);
                $this->redirect('/?action=listUserAd', ['before' => 'delete']);
            }
        }
        
        $this->view->render('deleteAd', ['ad' => $this->getAdUser()]);
    }
    
    public function deleteAppAction(): void
    {
        if ($this->isSession()) {
            if ($this->request->hasPost()) {
                $this->database->deleteApp((int) $this->request->postParam('id'));
                $this->redirect('/?action=listUserApp', ['before' => 'delete']);
            } 
        }
        
        $this->view->render('deleteApp', ['app' => $this->getAppUser()]);
    }

    public function loginAction(): void
    {
        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
            header("location: /?action=listUserAd");
            exit;
        }
        
        $this->singIn();
        
        $this->view->render('login', 
            [
                'error' => $this->request->getParam('error'),
                'before' => $this->request->getParam('before')
            ]);
    }
    
    public function logoutAction(): void
    {
        $this->stopSession();
    }
    
    public function registerAction(): void
    {
        if ($this->request->hasPost()) {
            $registerData = [
                'login' => $this->request->postParam('login'),
                'password' => $this->request->postParam('password'),
                'confirmPassword' => $this->request->postParam('confirmPassword'),
                'email' => $this->request->postParam('email')
            ];
            
            If (empty($registerData['login']) || empty($registerData['password']) || empty($registerData['confirmPassword']) || empty($registerData['email'])) {
                $this->redirect('/?action=register', ['error' => 'emptyData']);
            }
            
            if (!empty($this->database->validateLogin($registerData['login']))) {
                $this->redirect('/?action=register', ['error' => 'nameLogin']);
            }
            
            if (!empty($this->database->validateEmail($registerData['email']))) {
                $this->redirect('/?action=register', ['error' => 'nameEmail']);
            }
            
            if (!preg_match('/^[a-zA-Z0-9ęóąśłżźń]{4,30}$/', $registerData['login'])) {
                $this->redirect('/?action=register', ['error' => 'validLogin']);
            }
            
            if ($registerData['password'] !== $registerData['confirmPassword']) {
                $this->redirect('/?action=register', ['error' => 'confirmPassword']);
            }
            
            $this->database->register($registerData);
            $this->redirect('/?action=login', ['before' => 'register']);
  
        }
        $this->view->render('register', ['error' => $this->request->getParam('error')]);  
    }
    
    public function createAction(): void
    {      
        if (empty($_SESSION)) {
            $this->redirect('/?action=login', ['error' => 'loggedin']);
        }

        $this->createAd();
        $this->view->render('create', [
            'error' => $this->request->getParam('error')
            
        ]);
    }

    private function singIn(): void
    {
        if ($this->request->hasPost()) {
            $loginData = [
                'login' => $this->request->postParam('login'),
                'password' => $this->request->postParam('password')
            ];
            
            if (empty($loginData['login']) && empty($loginData['password'])) {
                $this->redirect('/?action=login', ['error' => 'emptyData']);
            }
            
            if (empty($this->database->validateLogin($loginData['login']))) {
                $this->redirect('/?action=login', ['error' => 'errorLogin']);
            }
                
            $userData = $this->database->login($loginData);
            if (!password_verify($loginData['password'], $userData['password'])) {
                $this->redirect('/?action=login', ['error' => 'wrongPassword']);
            }

            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $userData['id'];
            $_SESSION["username"] = $userData['login'];
            header("location: /?action=listUserAd");
        }
    }

    private function stopSession(): void
    {
        session_destroy();
        header("location: /");
        exit;
    }

    private function isSession(): bool
    {
        if (empty($_SESSION)) {
            header("Location: /?action=login");
        }
        return true;
    }

    private function changePassword(): void
    {
        if ($this->request->hasPost()) {
            $passData = [
                'oldPassword' => $this->request->postParam('oldPassword'),
                'newPassword' => $this->request->postParam('newPassword'),
                'confirmNewPassword' => $this->request->postParam('confirmNewPassword')
            ];
            
            if (empty($passData['oldPassword']) || empty($passData['newPassword']) || empty($passData['confirmNewPassword'])) {
                $this->redirect('/?action=settingsUser', ['error' => 'emptyData']);
            }
            
            $oldPassword = $this->database->checkPassword((int) $_SESSION['id']);
            if (!password_verify($passData['oldPassword'], $oldPassword['password'])) {
                $this->redirect('/?action=settingsUser', ['error' => 'wrongPassword']);
            }
            
            if ($passData['newPassword'] === $passData['oldPassword']) {
                $this->redirect('/?action=settingsUser', ['error' => 'checkPassword']);
            }
            
            if ($passData['newPassword'] !== $passData['confirmNewPassword']) {
                $this->redirect('/?action=settingsUser', ['error' => 'confirmPassword']);
            }
            
            $this->database->changePassword($passData, (int) $_SESSION['id']);
            $this->redirect('/?action=settingsUser', ['before' => 'changePassword']);
        }
    }

    private function deleteUser(): void
    {
        if ($this->request->hasPost()) {
            $this->database->deleteUser((int) $_SESSION['id']);
            $this->database->deleteAdsUser((int) $_SESSION['id']);
            session_destroy();
            $this->redirect('/?action=login', ['before' => 'deleteUser']);
        }
    }

    private function getAppUser(): array
    {
        return $this->database->getApp((int)$this->request->getParam('id'), (int) $_SESSION['id']);
    }
    
    private function getAdUser(): array
    {
        return $this->database->getAdUser((int)$this->request->getParam('id'), (int) $_SESSION['id']);
    }

    private function createAd()
    {
        if ($this->request->hasPost()) {
            $adData = [
                'company' => $this->request->postParam('company'),
                'locationCompany' => $this->request->postParam('locationCompany'),
                'descriptionCompany' => $this->request->postParam('descriptionCompany'),
                'title' => $this->request->postParam('title'),
                'position' => $this->request->postParam('position'),
                'level' => $this->request->postParam('level'),
                'contract' => $this->request->postParam('contract'),
                'locationJob' => $this->request->postParam('locationJob'),
                'salaryFrom' => $this->request->postParam('salaryFrom'),
                'salaryTo' => $this->request->postParam('salaryTo'),
                'salary' => $this->request->postParam('salary'),
                'currency' => $this->request->postParam('currency'),
                'descriptionNeeds' => $this->request->postParam('descriptionNeeds')  
            ];
            
            if (empty($adData['company']) || empty($adData['locationCompany']) || empty($adData['title']) || empty($adData['position'])
                || empty($adData['descriptionNeeds'])) {
                    $this->redirect('/?action=create', ['error' => 'emptyData']);
                }
                
                if (!preg_match('/^[a-zA-Zęóąśłżźń]|[a-zA-Zęóąśłżźń]+\s[a-zA-Zęóąśłżźń]{4,30}$/', $adData['locationCompany'])) {
                    $this->redirect('/?action=create', ['error' => 'locationCompany']);
                }
                

                $this->database->createAd($adData, $_SESSION['id']);
                $this->redirect('/?', ['before' => 'created']);
        }
    }
}