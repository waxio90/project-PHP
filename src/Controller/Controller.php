<?php 

declare(strict_types=1);

namespace App\Controller;

class Controller extends AccountController
{
    public function applyAction(): void
    {
        if ($this->request->hasPost()) {
            $applyData = [
                'idOffer' => $this->request->postParam('idOffer'),
                'idUser' => $this->request->postParam('idUser'),
                'name' => $this->request->postParam('name'),
                'lastName' => $this->request->postParam('lastName'),
                'email' => $this->request->postParam('email'),
                'phone' => $this->request->postParam('phone'),
            ];
            
            if (empty($applyData['name']) || empty($applyData['lastName']) || empty($applyData['email']) || empty($applyData['phone'])) {
                $this->redirect('/?action=apply&id='.$applyData['idOffer'], ['error' => 'emptyData']);
            }
            
            if (!preg_match('/^[a-zA-Zęóąśłżźń]{3,30}$/', $applyData['name'])) {
                $this->redirect('/?action=apply&id='.$applyData['idOffer'], ['error' => 'name']);
            }
            
            if (!preg_match('/^[a-zA-Zęóąśłżźń]{3,30}$/', $applyData['lastName'])) {
                $this->redirect('/?action=apply&id='.$applyData['idOffer'], ['error' => 'lastName']);
            }
            
            if (!is_uploaded_file($_FILES['fileCV']['tmp_name'])) {
                $this->redirect('/?action=apply&id='.$applyData['idOffer'], ['error' => 'emptyFile']);
            }
            
            if ($_FILES['fileCV']['size'] > self::MAX_FILE_SIZE) {
                $this->redirect('/?action=apply&id='.$applyData['idOffer'], ['error' => 'sizeFile']);
            }
            
            if ($_FILES['fileCV']['type'] !== self::SUPPORTED_TYPES) {
                $this->redirect('/?action=apply&id='.$applyData['idOffer'], ['error' => 'typeFile']);
            }
            
            $nameTmp = $_FILES['fileCV']['tmp_name'];
            $nameFile =  date("Y-m-d").$_FILES['fileCV']['size'].$_FILES['fileCV']['name'];
            move_uploaded_file($nameTmp, "uploads/$nameFile");
            $this->adModel->applyAd($applyData, $nameFile);
            $this->redirect('/?action=show&id='.$applyData['idOffer'], ['before' => 'apply']);
        }
        
        $this->view->render('apply', [
            'ad' => $this->getAd(),
            'error' => $this->request->getParam('error')
        ]);
    }
    
    public function showAction(): void
    {
        $this->counter();
        $this->view->render('show', [
            'ad' => $this->getAd(),
            'before' => $this->request->getParam('before')
        ]);
    }
    
    public function listAction(): void
    {
        $phrase = $this->request->getParam('phrase');
        
        if ($phrase) {
            $adOffersList = $this->adModel->search($phrase);
        } else {
            $adOffersList = $this->adModel->getAdOffers();
        }
        $this->view->render('list', 
            [
                'ads' => $adOffersList,
                'before' => $this->request->getParam('before')
            ]);
    }

    private function counter(): void
    {
        $counter = $this->adModel->getCounter((int) $this->request->getParam('id'));
        $counter++;
        $this->adModel->updateCounter((int) $counter, (int) $this->request->getParam('id'));
    }
    
    private function getAd(): array
    {
        $adId = (int) $this->request->getParam('id');
        return $this->adModel->getAd($adId);
    }

}