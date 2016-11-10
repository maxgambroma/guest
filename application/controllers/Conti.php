<?php

class Conti extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('conti_model');
        $this->load->model('camere_model');
        $this->load->model('foglio_model');
        $this->load->model('agenda_model');
        $this->load->model('tipologia_camere_model');
        $this->load->model('agenzia_model');
    }

    /**
     * Funzione per l'addebito su un conto
     */
    function addebita() {

        $data['conto_id'] = $this->input->get('conto_id');
        // elenco dei prodotti
        $data['prodotti'] = $this->conti_model->elenco_prodotti($this->hotel_id);

        $this->template->write('title', 'Foglio del Giorno');
        $this->template->write_view('top_1', 'top_1', $data);
        $this->template->write_view('top_2', 'top_2', $data);
        $this->template->write_view('top_3', 'top_3', $this->data);
        $this->template->write_view('contenitore_centro_1', 'contenitore_centro_1', $data);
        $this->template->write_view('contenitore_centro_2', 'contenitore_centro_2', $data);
        $this->template->write_view('contenitore_centro_3', 'contenitore_centro_3', $data);
        $this->template->write_view('menu_centrale', 'menu_centrale', $data);
        $this->template->write_view('sidebar_sinistra', 'sideleft_conti', $data);
        $this->template->write_view('content_tex', 'conti_addebita_view', $data);
        $this->template->write_view('sidebar', 'sideright', $data);
        $this->template->write_view('foot_1', 'foot_1', $data);
        $this->template->write_view('foot_2', 'foot_2', $data);
        $this->template->write_view('foot_3', 'foot_3', $data);

        $this->template->render();
    }

    function conferma_addebito() {

        $prodotto_id = $this->input->post('prodotto');
        $prezzo_prodotto = $this->conti_model->prodotto_from_id($prodotto_id);
        $data['prezzo_prodotto'] = $prezzo_prodotto[0]->prezzo_prodotto;
        $data['nome_prodotto'] = $prezzo_prodotto[0]->nome_prodotto;
        $data['prodotto_id'] = $prezzo_prodotto[0]->prodotto_id;
        $data['quantita'] = $this->input->post('quantita');

        $data['conto_id'] = $this->input->post('conto_id');
        $data['prodotti'] = $this->conti_model->elenco_prodotti($this->hotel_id);

        $this->template->write('title', 'Foglio del Giorno');
        $this->template->write_view('top_1', 'top_1', $data);
        $this->template->write_view('top_2', 'top_2', $data);
        $this->template->write_view('top_3', 'top_3', $this->data);
        $this->template->write_view('contenitore_centro_1', 'contenitore_centro_1', $data);
        $this->template->write_view('contenitore_centro_2', 'contenitore_centro_2', $data);
        $this->template->write_view('contenitore_centro_3', 'contenitore_centro_3', $data);
        $this->template->write_view('menu_centrale', 'menu_centrale', $data);
        $this->template->write_view('sidebar_sinistra', 'sideleft_conti', $data);
        $this->template->write_view('content_tex', 'conti_conferma_addebito_view', $data);
        $this->template->write_view('sidebar', 'sideright', $data);
        $this->template->write_view('foot_1', 'foot_1', $data);
        $this->template->write_view('foot_2', 'foot_2', $data);
        $this->template->write_view('foot_3', 'foot_3', $data);

        $this->template->render();
    }

    /**
     * Funzione per l'acquisto di un prodotto (assegna un prodotto a un conto nel db)
     */
    function acquista_prodotti() {

        $dati_insert = array(
            'conto_id' => $this->input->post('conto_id'),
            'hotel_id' => $this->input->post('hotel_id'),
            'prodotto_id' => $this->input->post('prodotto_id'),
            'descrizione' => $this->input->post('nome_prodotto'),
            'prezzo' => $this->input->post('prezzo'),
            'quantita' => $this->input->post('quantita'),
            'adebiti_utente_id' => $this->utente_id
        );

        if ($this->conti_model->acquista_prodotto($dati_insert) == TRUE) {
            redirect('conti/conti_partenza/?conto_id=' . $this->input->post('conto_id'));
        }
    }

    // Elenco dei conti relativi ad una camera
    function conti_partenza() {
        $conto_id = $this->input->get('conto_id');

        $data['dati_conto'] = $this->conti_model->rs_conto_id($conto_id, $this->today);
        $data['extra'] = $this->conti_model->rs_tot_extra($this->hotel_id, $conto_id);
        $data['extra_elenco'] = $this->conti_model->rs_elenca_extra($this->hotel_id, $conto_id);
        $data['tot_conto_camera'] = $this->conti_model->totale_conto_camera($this->hotel_id, $conto_id);
        $data['cliente'] = $this->conti_model->rs_rif_cliente($this->hotel_id, $conto_id);
        $data['acconti'] = $this->conti_model->rs_elenco_acconti($this->hotel_id, $conto_id);
        $data['conti_note'] = $this->conti_model->get_conti_note($this->hotel_id, $conto_id);
        $data['preno_dal'] = $data['dati_conto'][0]->in_conto;

//        echo "<pre>";
//        print_r($data['dati_conto']);
//        echo "</pre>";

        $this->template->write('title', 'Foglio del Giorno');
        $this->template->write_view('top_1', 'top_1', $data);
        $this->template->write_view('top_2', 'top_2', $data);
        $this->template->write_view('top_3', 'top_3', $this->data);
        $this->template->write_view('contenitore_centro_1', 'contenitore_centro_1', $data);
        $this->template->write_view('contenitore_centro_2', 'contenitore_centro_2', $data);
        $this->template->write_view('contenitore_centro_3', 'contenitore_centro_3', $data);
        $this->template->write_view('menu_centrale', 'menu_centrale', $data);
        $this->template->write_view('sidebar_sinistra', 'sideleft_conti', $data);
        $this->template->write_view('content_tex', 'conti_partenza_view', $data);
        $this->template->write_view('sidebar', 'sideright', $data);
        $this->template->write_view('foot_1', 'foot_1', $data);
        $this->template->write_view('foot_2', 'foot_2', $data);
        $this->template->write_view('foot_3', 'foot_3', $data);

        $this->template->render();
    }

    /*
     * Inserisce una nota per un conto
     */
    function conti_note() {

        $conto_id = $this->input->get('conto_id');

        $data['conti_note'] = $this->conti_model->get_conti_note($this->hotel_id, $conto_id);
        $data['dati_conto'] = $this->conti_model->rs_conto_id($conto_id, $this->today);
        $data['preno_dal'] = $data['dati_conto'][0]->in_conto;

        if ($this->input->post('aggiungi_nota')) {
            $array_insert = array(
                'conto_id' => $conto_id,
                'hotel_id' => $this->hotel_id,
                'conto_nota_testo' => $this->input->post('conto_nota_testo'),
                'note_conto_utente_id' => $this->utente_id
            );

            $this->conti_model->inserisci_nota($array_insert);

            redirect("conti/conti_note/?conto_id=$conto_id");
        }

        $this->template->write('title', 'Foglio del Giorno');
        $this->template->write_view('top_1', 'top_1', $data);
        $this->template->write_view('top_2', 'top_2', $data);
        $this->template->write_view('top_3', 'top_3', $this->data);
        $this->template->write_view('contenitore_centro_1', 'contenitore_centro_1', $data);
        $this->template->write_view('contenitore_centro_2', 'contenitore_centro_2', $data);
        $this->template->write_view('contenitore_centro_3', 'contenitore_centro_3', $data);
        $this->template->write_view('menu_centrale', 'menu_centrale', $data);
        $this->template->write_view('sidebar_sinistra', 'sideleft_conti', $data);
        $this->template->write_view('content_tex', 'conti_note_view', $data);
        $this->template->write_view('sidebar', 'sideright', $data);
        $this->template->write_view('foot_1', 'foot_1', $data);
        $this->template->write_view('foot_2', 'foot_2', $data);
        $this->template->write_view('foot_3', 'foot_3', $data);

        $this->template->render();
    }

    /**
     * Modifica un pagamento effettuato
     */
    function modifica_pagamento() {

        $cassa_id = $this->input->get('cassa_id');

        $data['pagamento'] = $this->conti_model->estrai_pagamento_from_id($this->hotel_id, $cassa_id);

        if ($this->input->post('modifica')) {
            $dati_update = array(
                'pagamento_importo_pag' => $this->input->post('importo'),
                'pagamento_forma' => $this->input->post('modalita')
            );

            $conto_id = $this->input->post('conto_id');

            $this->conti_model->modifica_pagamento($this->hotel_id, $cassa_id, $dati_update);

            redirect("conti/conti_partenza?conto_id=$conto_id");
        }

        $this->template->write('title', 'Foglio del Giorno');
        $this->template->write_view('top_1', 'top_1', $data);
        $this->template->write_view('top_2', 'top_2', $data);
        $this->template->write_view('top_3', 'top_3', $this->data);
        $this->template->write_view('contenitore_centro_1', 'contenitore_centro_1', $data);
        $this->template->write_view('contenitore_centro_2', 'contenitore_centro_2', $data);
        $this->template->write_view('contenitore_centro_3', 'contenitore_centro_3', $data);
        $this->template->write_view('menu_centrale', 'menu_centrale', $data);
        $this->template->write_view('sidebar_sinistra', 'sideleft_conti', $data);
        $this->template->write_view('content_tex', 'conti_modifica_pagamento_view', $data);
        $this->template->write_view('sidebar', 'sideright', $data);
        $this->template->write_view('foot_1', 'foot_1', $data);
        $this->template->write_view('foot_2', 'foot_2', $data);
        $this->template->write_view('foot_3', 'foot_3', $data);

        $this->template->render();
    }

    /**
     * Apre un conto
     */
    function apri_conto_preno() {

        // controlla se esiste già un conto aperto per quella camera
        $data['controllo'] = $this->conti_model->rs_controllo_stato_conto($this->hotel_id, $this->input->get('camera_id'));

        $data['preno_id'] = $this->input->get('preno_id');
        $data['foglio_id'] = $this->input->get('foglio_id');

        // estrai i dati della prenotazione
        $data['prenotazione'] = $this->foglio_model->dati_from_foglio($this->hotel_id, $data['foglio_id']);
        // estrae il tipo di camera
        $data['tipo_camera'] = $this->tipologia_camere_model->tipologia_camera_dettagli($this->input->get('camera_id'));

        $preno_dal = $data['prenotazione'][0]->preno_dal;

        $data['preno_dal'] = $preno_dal;
        //elenca le agenzie
        $data['agenzie'] = $this->agenzia_model->rs_agenzie_elenco();

        // elenca le note
        $data['note'] = $this->agenda_model->get_note($this->hotel_id, $data['preno_id']);

        $this->template->write('title', 'Apri Conto Preno');
        $this->template->write_view('top_1', 'top_1', $data);
        $this->template->write_view('top_2', 'top_2', $data);
        $this->template->write_view('top_3', 'top_3', $this->data);
        $this->template->write_view('contenitore_centro_1', 'contenitore_centro_1', $data);
        $this->template->write_view('contenitore_centro_2', 'contenitore_centro_2', $data);
        $this->template->write_view('contenitore_centro_3', 'contenitore_centro_3', $data);
        $this->template->write_view('menu_centrale', 'menu_centrale', $data);
        $this->template->write_view('sidebar_sinistra', 'sideleft_conti', $data);
        $this->template->write_view('content_tex', 'conto_apri_preno_view', $data);
        $this->template->write_view('sidebar', 'sideright', $data);
        $this->template->write_view('foot_1', 'foot_1', $data);
        $this->template->write_view('foot_2', 'foot_2', $data);
        $this->template->write_view('foot_3', 'foot_3', $data);
        // Render the template
        $this->template->render();
    }

//    function apri_conto_diretto() {
//
//        // controlla se esiste già un conto aperto per la camera
//        $data['controllo'] = $this->conti_model->rs_controllo_stato_conto($this->hotel_id, $this->input->get('camera_id'));
//
//        $data['preno_id'] = $this->input->get('preno_id');
//        $data['foglio_id'] = $this->input->get('foglio_id');
//
//        // estrae i dati della prenotazione
//        $data['prenotazione'] = $this->foglio_model->dati_from_foglio($this->hotel_id, $data['foglio_id']);
//        $data['tipo_camera'] = $this->tipologia_camere_model->tipologia_camera_dettagli($this->input->get('camera_id'));
//
//        $data['elenco_tipi_camera'] = $this->tipologia_camere_model->tipologia_camere($this->hotel_id);
//
//        $preno_dal = $this->today;
//
//        $data['preno_dal'] = $preno_dal;
//        $data['agenzie'] = $this->agenzia_model->rs_agenzie_elenco();
//
//        $data['note'] = $this->agenda_model->get_note($this->hotel_id, $data['preno_id']);
//
//        $this->template->write('title', 'Apri Conto Preno');
//        $this->template->write_view('top_1', 'top_1', $data);
//        $this->template->write_view('top_2', 'top_2', $data);
//        $this->template->write_view('top_3', 'top_3', $this->data);
//        $this->template->write_view('contenitore_centro_1', 'contenitore_centro_1', $data);
//        $this->template->write_view('contenitore_centro_2', 'contenitore_centro_2', $data);
//        $this->template->write_view('contenitore_centro_3', 'contenitore_centro_3', $data);
//        $this->template->write_view('menu_centrale', 'menu_centrale', $data);
//        $this->template->write_view('sidebar_sinistra', 'sideleft_conti', $data);
//        $this->template->write_view('content_tex', 'conto_diretto_apri_view', $data);
//        $this->template->write_view('sidebar', 'sideright', $data);
//        $this->template->write_view('foot_1', 'foot_1', $data);
//        $this->template->write_view('foot_2', 'foot_2', $data);
//        $this->template->write_view('foot_3', 'foot_3', $data);
//// Render the template
//        $this->template->render();
//    }

    /**
     * Modifica un conto
     */
    function modifica_conto() {

        $conto_id = $this->input->get('conto_id');

        $data['dati_conto'] = $this->conti_model->rs_conto_id($conto_id, $this->today);

        $data['prenotazione'] = $this->conti_model->rs_conto_id($conto_id, $this->today);

        $data['preno_id'] = $data['prenotazione'][0]->preno_id;
        $data['foglio_id'] = $data['prenotazione'][0]->foglio_id;

        $data['tipo_camera'] = $this->tipologia_camere_model->tipologia_camera_dettagli($data['prenotazione'][0]->camera_id);

        $preno_dal = $data['prenotazione'][0]->in_conto;

        $data['preno_dal'] = $preno_dal;
        $data['agenzie'] = $this->agenzia_model->rs_agenzie_elenco();

        $data['note'] = $this->agenda_model->get_note($this->hotel_id, $data['preno_id']);

        // se è passato un post
        if ($this->input->post('modifica_conto')) {

            // prende tutti i dati della post
            $dati = $this->input->post();

            // scrive un backup prima di modificare
            $this->conti_model->backup_riga_conto($this->hotel_id, $conto_id);
            // mdifica su foglio
            $this->conti_model->modifica_conto_foglio($this->hotel_id, $dati);
            //modifica su conto
            $this->conti_model->modifica_conto_conti($this->hotel_id, $dati);

            $numero_camera = $this->input->post('numero_camera');

            // manda una mail all'admin (DA COMPLETARE)
            $from = $this->data['dati_hotel']->hotel_email;
            $to = $this->admin_email;
            $subject = "!@ $this->hotel_id Modifica Conto $numero_camera";
            $message = "Camera Numero: \n
                        Cognome:\n
                        Nome: \n
                        Data di arrivo:\n
                        Data di partenza:\n
                        Tipo Camera:\n
                        Trattamento:\n
                        Prezzo:\n
                        Agenzia:\n";

            $this->email_di_notifica($from, $to, $subject, $message);

            redirect('conti/conti_partenza/?conto_id=' . $this->input->post('conto_id'));
        }

        $this->template->write('title', 'Apri Conto Preno');
        $this->template->write_view('top_1', 'top_1', $data);
        $this->template->write_view('top_2', 'top_2', $data);
        $this->template->write_view('top_3', 'top_3', $this->data);
        $this->template->write_view('contenitore_centro_1', 'contenitore_centro_1', $data);
        $this->template->write_view('contenitore_centro_2', 'contenitore_centro_2', $data);
        $this->template->write_view('contenitore_centro_3', 'contenitore_centro_3', $data);
        $this->template->write_view('menu_centrale', 'menu_centrale', $data);
        $this->template->write_view('sidebar_sinistra', 'sideleft_conti', $data);
        $this->template->write_view('content_tex', 'conto_modifica_view', $data);
        $this->template->write_view('sidebar', 'sideright', $data);
        $this->template->write_view('foot_1', 'foot_1', $data);
        $this->template->write_view('foot_2', 'foot_2', $data);
        $this->template->write_view('foot_3', 'foot_3', $data);
// Render the template
        $this->template->render();
    }

    /**
     * Sospamento camera
     */
    function sposta_camera() {

        $conto_id = $this->input->get('conto_id');

        $data['prenotazione'] = $this->conti_model->rs_conto_id($conto_id, $this->today);
        $data['tipo_camera'] = $this->tipologia_camere_model->tipologia_camera_dettagli($data['prenotazione'][0]->camera_id);

        $preno_dal = $data['prenotazione'][0]->in_conto;
        $preno_al = $data['prenotazione'][0]->out_preno;

        $data['preno_id'] = $data['prenotazione'][0]->preno_id;
        $data['preno_dal'] = $preno_dal;
        $data['preno_al'] = $preno_al;

        $data['camere_libere'] = $this->foglio_model->rs_camere_dispobili($this->hotel_id, $preno_dal, $preno_al);

//        echo "<pre>";
//        print_r($data['camere_libere']);
//        echo "</pre>";

        //se c'è flag su conferma
        if ($this->input->post('sposta_camera') && $this->input->post('conferma') == 100) {

            $dati = $this->input->post();

            // backup
            $this->conti_model->backup_riga_conto($this->hotel_id, $conto_id);
            // midifica su foglio
            $this->conti_model->sposta_camera_foglio($this->hotel_id, $dati);
            // modifica su conto
            $this->conti_model->sposta_camera_conti($this->hotel_id, $dati);

            redirect('conti/conti_partenza/?conto_id=' . $this->input->post('conto_id'));
            
        //se non c'è flag su conferma, torna un messaggio di errore
        } elseif ($this->input->post('sposta_camera') && $this->input->post('conferma') != 100) {

            $data['error_conferma'] = 'Devi selezionare la conferma per effettuare lo spostamento.';

            $this->template->write('title', 'Apri Conto Preno');
            $this->template->write_view('top_1', 'top_1', $data);
            $this->template->write_view('top_2', 'top_2', $data);
            $this->template->write_view('top_3', 'top_3', $this->data);
            $this->template->write_view('contenitore_centro_1', 'contenitore_centro_1', $data);
            $this->template->write_view('contenitore_centro_2', 'contenitore_centro_2', $data);
            $this->template->write_view('contenitore_centro_3', 'contenitore_centro_3', $data);
            $this->template->write_view('menu_centrale', 'menu_centrale', $data);
            $this->template->write_view('sidebar_sinistra', 'sideleft_conti', $data);
            $this->template->write_view('content_tex', 'conto_sposta_camera_view', $data);
            $this->template->write_view('sidebar', 'sideright', $data);
            $this->template->write_view('foot_1', 'foot_1', $data);
            $this->template->write_view('foot_2', 'foot_2', $data);
            $this->template->write_view('foot_3', 'foot_3', $data);
            // Render the template
            $this->template->render();
        }

        $this->template->write('title', 'Apri Conto Preno');
        $this->template->write_view('top_1', 'top_1', $data);
        $this->template->write_view('top_2', 'top_2', $data);
        $this->template->write_view('top_3', 'top_3', $this->data);
        $this->template->write_view('contenitore_centro_1', 'contenitore_centro_1', $data);
        $this->template->write_view('contenitore_centro_2', 'contenitore_centro_2', $data);
        $this->template->write_view('contenitore_centro_3', 'contenitore_centro_3', $data);
        $this->template->write_view('menu_centrale', 'menu_centrale', $data);
        $this->template->write_view('sidebar_sinistra', 'sideleft_conti', $data);
        $this->template->write_view('content_tex', 'conto_sposta_camera_view', $data);
        $this->template->write_view('sidebar', 'sideright', $data);
        $this->template->write_view('foot_1', 'foot_1', $data);
        $this->template->write_view('foot_2', 'foot_2', $data);
        $this->template->write_view('foot_3', 'foot_3', $data);
        // Render the template
        $this->template->render();
    }

    /**
     * Elenca tutta la cronologia di un determinato conto
     */
    function cronologia_conto() {
        $conto_id = $this->input->get('conto_id');

        $data['dati_conto'] = $this->conti_model->rs_conto_id($conto_id, $this->today);
        $data['extra'] = $this->conti_model->rs_tot_extra($this->hotel_id, $conto_id);
        $data['extra_elenco'] = $this->conti_model->rs_elenca_extra($this->hotel_id, $conto_id);
        $data['tot_conto_camera'] = $this->conti_model->totale_conto_camera($this->hotel_id, $conto_id);
        $data['cliente'] = $this->conti_model->rs_rif_cliente($this->hotel_id, $conto_id);
        $data['acconti'] = $this->conti_model->rs_elenco_acconti($this->hotel_id, $conto_id);
        $data['conti_note'] = $this->conti_model->get_conti_note($this->hotel_id, $conto_id);
        $data['preno_dal'] = $data['dati_conto'][0]->in_conto;
        $data['cronologia_elenco'] = $this->conti_model->cronologia_elenco($this->hotel_id, $conto_id);

        if (trim($this->input->get('id_mod_conto')) != '') {
            $data['conto_modificato'] = $this->conti_model->cronologia_elenco_from_id($this->hotel_id, $this->input->get('id_mod_conto'));
        }
//        echo "<pre>";
//        print_r($data['dati_conto']);
//        echo "</pre>";

        $this->template->write('title', 'Foglio del Giorno');
        $this->template->write_view('top_1', 'top_1', $data);
        $this->template->write_view('top_2', 'top_2', $data);
        $this->template->write_view('top_3', 'top_3', $this->data);
        $this->template->write_view('contenitore_centro_1', 'contenitore_centro_1', $data);
        $this->template->write_view('contenitore_centro_2', 'contenitore_centro_2', $data);
        $this->template->write_view('contenitore_centro_3', 'contenitore_centro_3', $data);
        $this->template->write_view('menu_centrale', 'menu_centrale', $data);
        $this->template->write_view('sidebar_sinistra', 'sideleft_conti', $data);
        $this->template->write_view('content_tex', 'conti_cronologia_view', $data);
        $this->template->write_view('sidebar', 'sideright', $data);
        $this->template->write_view('foot_1', 'foot_1', $data);
        $this->template->write_view('foot_2', 'foot_2', $data);
        $this->template->write_view('foot_3', 'foot_3', $data);

        $this->template->render();
    }

    /**
     * Funzione per il traferimento di un conto
     */
    function trasferisci_conto() {
        if (trim($this->input->get('conto_id')) != '') {
            $conto_id = $this->input->get('conto_id');
        } else {
            $conto_id = $this->input->post('conto_id');
        }

        // TUTTI I DATI DEL CONTO
        $data['dati_conto'] = $this->conti_model->rs_conto_id($conto_id, $this->today);
        $data['extra'] = $this->conti_model->rs_tot_extra($this->hotel_id, $conto_id);
        $data['extra_elenco'] = $this->conti_model->rs_elenca_extra($this->hotel_id, $conto_id);
        $data['tot_conto_camera'] = $this->conti_model->totale_conto_camera($this->hotel_id, $conto_id);
        $data['cliente'] = $this->conti_model->rs_rif_cliente($this->hotel_id, $conto_id);
        $data['acconti'] = $this->conti_model->rs_elenco_acconti($this->hotel_id, $conto_id);
        $data['conti_note'] = $this->conti_model->get_conti_note($this->hotel_id, $conto_id);
        $data['preno_dal'] = $data['dati_conto'][0]->in_conto;
        $data['elenco_camere'] = $this->conti_model->rs_conti_aperti_elenco($this->hotel_id);

//        echo "<pre>";
//        print_r($data['dati_conto']);
//        echo "</pre>";

        // se è settato il post di trasferimento
        if ($this->input->post('trasferisci') != '') {

            // definisco l'importo da trasferire
            $importo_da_trasferire_positivo = $this->input->post('importo_trasferire');
            $importo_da_trasferire_negativo = ($importo_da_trasferire_positivo * -1);

            $dati_insert_negativo = array(
                'conto_id' => $this->input->post('conto_id'),
                'hotel_id' => $this->input->post('hotel_id'),
                'prodotto_id' => $this->input->post('prodotto_id'),
                'prezzo' => $importo_da_trasferire_negativo,
                'quantita' => $this->input->post('quantita'),
                'adebiti_utente_id' => $this->utente_id
            );

            // sottraggo l'importo alla stanza che lascio
            $this->conti_model->acquista_prodotto($dati_insert_negativo);

            $dati_insert_positivo = array(
                'conto_id' => $this->input->post('nuovo_conto'),
                'hotel_id' => $this->input->post('hotel_id'),
                'prodotto_id' => $this->input->post('prodotto_id'),
                'prezzo' => $importo_da_trasferire_positivo,
                'quantita' => $this->input->post('quantita'),
                'adebiti_utente_id' => $this->utente_id
            );

            // aggiungo l'importo alla stanza dove trasferisco
            $this->conti_model->acquista_prodotto($dati_insert_positivo);

            $this->db->select('LAST_INSERT_ID() as insert_id');
            $this->db->from('adebiti');
            $query = $this->db->get();
            $result = $query->row();
            $last_insert_id = $result->insert_id;

            $dati_insert_conti_trasferisci = array(
                'conto_id_ex' => $this->input->post('conto_id'),
                'conto_id_new' => $this->input->post('nuovo_conto'),
                'hotel_id' => $this->input->post('hotel_id'),
                'adebito_id' => $last_insert_id
            );

            // scrivo sul db la traccia del trasferimento
            $this->conti_model->conti_trasferisci($dati_insert_conti_trasferisci);

            redirect('conti/conti_partenza/?conto_id=' . $this->input->post('conto_id'));
        }

        $this->template->write('title', 'Foglio del Giorno');
        $this->template->write_view('top_1', 'top_1', $data);
        $this->template->write_view('top_2', 'top_2', $data);
        $this->template->write_view('top_3', 'top_3', $this->data);
        $this->template->write_view('contenitore_centro_1', 'contenitore_centro_1', $data);
        $this->template->write_view('contenitore_centro_2', 'contenitore_centro_2', $data);
        $this->template->write_view('contenitore_centro_3', 'contenitore_centro_3', $data);
        $this->template->write_view('menu_centrale', 'menu_centrale', $data);
        $this->template->write_view('sidebar_sinistra', 'sideleft_conti', $data);
        $this->template->write_view('content_tex', 'conto_trasferisci_view', $data);
        $this->template->write_view('sidebar', 'sideright', $data);
        $this->template->write_view('foot_1', 'foot_1', $data);
        $this->template->write_view('foot_2', 'foot_2', $data);
        $this->template->write_view('foot_3', 'foot_3', $data);

        $this->template->render();
    }

    /**
     * Inserimento da prenotazione (arrivo cliente)
     */
    function inserisci_da_preno() {

        if (count($this->conti_model->rs_controllo_stato_conto($this->hotel_id, $this->input->get('camera_id'))) == 0 )  {

            $this->load->model('db_conti_model');

            $this->form_validation->set_rules('hotel_id', 'hotel_id', '');
            $this->form_validation->set_rules('foglio_id', 'foglio_id', '');
            $this->form_validation->set_rules('preno_dal', 'preno_dal', '');
            $this->form_validation->set_rules('in_conto_time', 'in_conto_time', '');
            $this->form_validation->set_rules('preno_al', 'preno_al', '');
            $this->form_validation->set_rules('preno_id', 'preno_id', '');
            $this->form_validation->set_rules('camera_id', 'camera_id', '');
            $this->form_validation->set_rules('numero_camera', 'numero_camera', '');
            $this->form_validation->set_rules('trattamento_sog', 'trattamento_sog', '');
            $this->form_validation->set_rules('nome_tipologia', 'nome_tipologia', '');
            $this->form_validation->set_rules('tipologia_id', 'tipologia_id', '');
            $this->form_validation->set_rules('prezzo', 'prezzo', '');
            $this->form_validation->set_rules('nome', 'nome', 'trim|xss_clean');
            $this->form_validation->set_rules('cognome', 'cognome', 'required|trim|xss_clean');
            $this->form_validation->set_rules('conferma', 'conferma', 'required|trim|xss_clean');
            $this->form_validation->set_rules('preno_agenzia', 'preno_agenzia', '');
            $this->form_validation->set_rules('mercato', 'mercato', 'trim|xss_clean');
            $this->form_validation->set_rules('conti_stato_camere', 'conti_stato_camere', '');
            $this->form_validation->set_rules('conto_pag_modalita', 'conto_pag_modalita', 'trim|xss_clean');

            $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');

            if ($this->form_validation->run() == FALSE) { // validation hasn't been passed
               
            redirect('conti/apri_conto_preno/?camera_id='.$this->input->post('camera_id').'&preno_id='.$this->input->post('preno_id').'&foglio_id='. $this->input->post('foglio_id'). '');

            } else { // passed validation proceed to post success logic
// build array for the model
                $form_data = array(
                    'conto_id' => $this->input->post('conto_id'),
                    'hotel_id' => $this->input->post('hotel_id'),
                    'foglio_id' => $this->input->post('foglio_id'),
                    'clienti_id' => $this->input->post('clienti_id'),
                    'in_conto' => $this->input->post('preno_dal'),
                    'out_preno' => $this->input->post('preno_al'),
                    'in_conto_time' => $this->input->post('in_conto_time'),
                    'out_conto' => $this->input->post('out_conto'),
                    'preno_id' => $this->input->post('preno_id'),
                    'camera_id' => $this->input->post('camera_id'),
                    'numero_camera' => $this->input->post('numero_camera'),
                    'trattamento_sog' => $this->input->post('trattamento'),
                    'tipo_camera' => $this->input->post('tipo_camera'),
                    'tipologia_id' => $this->input->post('tipologia_id'),
                    'prezzo' => $this->input->post('prezzo'),
                    'nome_cliente' => $this->input->post('nome'),
                    'cognome_cliente' => $this->input->post('cognome'),
                    'preno_agenzia' => $this->input->post('preno_agenzia'),
                    'mercato' => $this->input->post('mercato'),
                    'conti_stato_camere' => $this->input->post('stato_camera'),
                    'acconto' => $this->input->post('acconto'),
                    'conto_pag_modalita' => $this->input->post('pagamento_modalita'),
                    'conti_utente_id' => $this->session->userdata('utente_id')
                );

                // salvo i dati nel db
                if ($this->db_conti_model->SaveForm($form_data) == TRUE) {
                    $this->db->select('LAST_INSERT_ID() as insert_id');
                    $this->db->from('conti');
                    $query = $this->db->get();
                    $result = $query->result();
                    $last_insert_id = $result[0]->insert_id;
                    
                    $form_data_update = array(
                        'conto_id' => $last_insert_id,
                        'hotel_id' => $this->input->post('hotel_id'),
                        'camera_id' => $this->input->post('camera_id'),
                        'preno_id' => $this->input->post('preno_id'),
                        'tipologia_id' => $this->input->post('tipologia_id'),
                        'numero_camera' => $this->input->post('numero_camera'),
                        'foglio_prezzo_camera' => $this->input->post('prezzo'),
                        'nome_cliente' => $this->input->post('nome'),
                        'cognome_cliente' => $this->input->post('cognome'),
                        'in_conto' => $this->input->post('preno_dal'),
                        'out_preno' => $this->input->post('preno_al'),
                        'preno_agenzia' => $this->input->post('preno_agenzia'),
                        'stato_camera' => $this->input->post('stato_camera')
                    );

                    if (trim($this->input->post('conto_nota_testo')) != '') {

                        $array_insert = array('conto_nota_testo' => $this->input->post('conto_nota_testo'), 'conto_id' => $last_insert_id, 'hotel_id' => $this->hotel_id, 'note_conto_utente_id' => $this->utente_id);

                        $this->db->insert('conti_note', $array_insert);
                    }

                    $foglio_id = $this->input->post('foglio_id');

                    // eseguo l'update della prenotazione registrando l'arrivo
                    $this->foglio_model->rs_update_foglio($form_data_update, $foglio_id);
                    $preno_id = $this->input->post('preno_id');

                    redirect('prenotazioni/dettagli/?preno_id=' . $preno_id);
                } else {
                    echo 'An error occurred saving your information. Please try again later';
                }
            }
        } else {
            redirect('conto/apri_conto_preno');
        }
    }

    /**
     * funzione per inserire l'arrivo di un cliente che non ha prenotato
     */
    function inserisci_diretto() {

        $this->load->model('db_conti_model');

        $this->form_validation->set_rules('hotel_id', 'hotel_id', '');
        $this->form_validation->set_rules('foglio_id', 'foglio_id', '');
        $this->form_validation->set_rules('camera_id', 'camera_id', '');
        $this->form_validation->set_rules('in_conto_time', 'in_conto_time', '');
        $this->form_validation->set_rules('numero_camera', 'numero_camera', '');
        $this->form_validation->set_rules('preno_dal', 'preno_dal', 'required');
        $this->form_validation->set_rules('preno_al', 'preno_al', 'required|trim|xss_clean');
        $this->form_validation->set_rules('nome', 'nome', 'trim|xss_clean');
        $this->form_validation->set_rules('cognome', 'cognome', 'required|trim|xss_clean');
        $this->form_validation->set_rules('trattamento_sog', 'trattamento_sog', 'required');
        $this->form_validation->set_rules('nome_tipologia', 'nome_tipologia', '');
        $this->form_validation->set_rules('tipologia_id', 'tipologia_id', 'required');
        $this->form_validation->set_rules('pagamento_modalita', 'pagamento_modalita', 'required');
        $this->form_validation->set_rules('prezzo', 'prezzo', 'required');
        $this->form_validation->set_rules('preno_agenzia', 'preno_agenzia', '');
        $this->form_validation->set_rules('mercato', 'mercato', 'trim|xss_clean');
        $this->form_validation->set_rules('conti_stato_camere', 'conti_stato_camere', '');
        $this->form_validation->set_rules('conto_pag_modalita', 'conto_pag_modalita', 'trim|xss_clean');
        $this->form_validation->set_rules('conto_nota_testo', 'conto_nota_testo', 'trim|xss_clean');
        $this->form_validation->set_rules('conferma', 'conferma', 'required|trim|xss_clean');

        
        $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            // controlla se la camera è aperta nel conti
             $data['controllo'] = $this->conti_model->rs_controllo_stato_conto($this->hotel_id, $this->input->get('camera_id'));
            //restituice i dati della camere 
            $data['tipo_camera'] = $this->tipologia_camere_model->tipologia_camera_dettagli($this->input->get('camera_id'));
            //possibili tipologir 
            $data['elenco_tipi_camera'] = $this->tipologia_camere_model->tipologia_camere($this->hotel_id);

            $preno_dal = $this->today;

            $data['preno_dal'] = $preno_dal;
            $data['agenzie'] = $this->agenzia_model->rs_agenzie_elenco();

             // carico il Templete
            $this->template->write('title', 'Apri Conto Diretto');
            $this->template->write_view('top_1', 'top_1', $data);
            $this->template->write_view('top_2', 'top_2', $data);
            $this->template->write_view('top_3', 'top_3', $this->data);
            $this->template->write_view('contenitore_centro_1', 'contenitore_centro_1', $data);
            $this->template->write_view('contenitore_centro_2', 'contenitore_centro_2', $data);
            $this->template->write_view('contenitore_centro_3', 'contenitore_centro_3', $data);
            $this->template->write_view('menu_centrale', 'menu_centrale', $data);
            //$this->template->write_view('sidebar_sinistra', 'sideleft_conti', $data);
            $this->template->write_view('content_tex', 'conto_diretto_apri_view', $data);
            $this->template->write_view('sidebar', 'sideright', $data);
            $this->template->write_view('foot_1', 'foot_1', $data);
            $this->template->write_view('foot_2', 'foot_2', $data);
            $this->template->write_view('foot_3', 'foot_3', $data);
            // confermo il Templete
            $this->template->render();
        } else { 
            // ho superato i controlli del form                       
            if (count($this->camere_model->check_disp_camera($this->input->post('preno_dal'), $this->input->post('preno_al'), $this->input->post('camera_id'))) == 0 )
               {  // se la camera è libera nel foglio && il conto non è gia aperto
                
                // max ID foglio 
                $this->db->select_max('foglio_id');
                $this->db->from('foglio_giorno');
                $query = $this->db->get();
                $result = $query->row();
                $last_insert_id = $result->foglio_id;
                $foglio_id = $last_insert_id + 1;
                
                // max ID Conti  
                $this->db->select_max('conto_id');
                $this->db->from('conti');
                $query = $this->db->get();
                $result = $query->row();
                $last_insert_id = $result->conto_id;
                $conto_id = $last_insert_id + 1;    
                
                // funione per ricavare tipologia_camera  
                $this->db->select('tipologia_camera');
                $this->db->from('camere');
                $this->db->where('tipologia_id', $this->input->post('tipologia_id'));
                $query = $this->db->get();
                $result = $query->row();
                $tipo_camera = $result->tipologia_camera;
                
                // sql per inserire in conti 
                $form_data = array(
                    'conto_id' => $conto_id,
                    'hotel_id' => $this->input->post('hotel_id'),
                    'foglio_id' => $foglio_id,
                    'in_conto' => $this->input->post('preno_dal'),
                    'out_preno' => $this->input->post('preno_al'),
                    'in_conto_time' => $this->input->post('in_conto_time'),
                    'out_conto' => $this->input->post('out_conto'),
                    'preno_id' => $this->input->post('preno_id'),
                    'camera_id' => $this->input->post('camera_id'),
                    'numero_camera' => $this->input->post('numero_camera'),
                    'trattamento_sog' => $this->input->post('trattamento_sog'),
                    'tipo_camera' => $tipo_camera,
                    'tipologia_id' => $this->input->post('tipologia_id'),
                    'prezzo' => $this->input->post('prezzo'),
                    'nome_cliente' => $this->input->post('nome'),
                    'cognome_cliente' => $this->input->post('cognome'),
                    'preno_agenzia' => $this->input->post('preno_agenzia'),
                    'mercato' => $this->input->post('mercato'),
                    'conti_stato_camere' => $this->input->post('stato_camera'),
                    'acconto' => $this->input->post('acconto'),
                    'conto_pag_modalita' => $this->input->post('pagamento_modalita'),
                    'conti_utente_id' => $this->session->userdata('utente_id')
                );

                // inserimento dati in conti
                $this->db_conti_model->SaveForm($form_data);

                $numero_camera = $this->camere_model->numero_camera($this->input->post('camera_id'));
                $numero_camera = $numero_camera->numero_camera;
                // sql per inserire foglio  
                $form_data_insert = array(
                    'conto_id' => $conto_id,
                    'foglio_id' => $foglio_id,
                    'hotel_id' => $this->input->post('hotel_id'),
                    'camera_id' => $this->input->post('camera_id'),
                    'preno_id' => $this->input->post('preno_id'),
                    'tipologia_id' => $this->input->post('tipologia_id'),
                    'numero_camera' => $numero_camera,
                    'foglio_prezzo_camera' => $this->input->post('prezzo'),
                    'nome_cliente' => $this->input->post('nome'),
                    'cognome_cliente' => $this->input->post('cognome'),
                    'in_conto' => $this->input->post('preno_dal'),
                    'out_preno' => $this->input->post('preno_al'),
                    'preno_agenzia' => $this->input->post('preno_agenzia'),
                    'stato_camera' => $this->input->post('stato_camera')
                );
                // inserisco le note dei conti
                if (trim($this->input->post('conto_nota_testo')) != '') {
                    $array_insert = array('conto_nota_testo' => $this->input->post('conto_nota_testo'), 'conto_id' => $last_insert_id, 'hotel_id' => $this->hotel_id, 'note_conto_utente_id' => $this->utente_id);
                    $this->db->insert('conti_note', $array_insert);
                }               
                // inserimento dati in foglio
                $this->foglio_model->rs_insert_foglio($form_data_insert);
echo "inserito " ;

                // redirect('foglio/');
            } else { // se la camera è gia assegnata nel foglio 

                
            
                
                $data['error'] = "Attenzione la camera risulta essere gi&agrave; prenotata, proseguire comunque?";
                $data['tipo_camera'] = $this->tipologia_camere_model->tipologia_camera_dettagli($this->input->post('camera_id'));

                $data['elenco_tipi_camera'] = $this->tipologia_camere_model->tipologia_camere($this->hotel_id);

                $preno_dal = $this->today;

                $data['preno_dal'] = $preno_dal;
                $data['agenzie'] = $this->agenzia_model->rs_agenzie_elenco();

                $this->template->write('title', 'Apri Conto Preno');
                $this->template->write_view('top_1', 'top_1', $data);
                $this->template->write_view('top_2', 'top_2', $data);
                $this->template->write_view('top_3', 'top_3', $this->data);
                $this->template->write_view('contenitore_centro_1', 'contenitore_centro_1', $data);
                $this->template->write_view('contenitore_centro_2', 'contenitore_centro_2', $data);
                $this->template->write_view('contenitore_centro_3', 'contenitore_centro_3', $data);
                $this->template->write_view('menu_centrale', 'menu_centrale', $data);
                $this->template->write_view('sidebar_sinistra', 'sideleft_conti', $data);
                $this->template->write_view('content_tex', 'conto_diretto_apri_conferma_view', $data);
                $this->template->write_view('sidebar', 'sideright', $data);
                $this->template->write_view('foot_1', 'foot_1', $data);
                $this->template->write_view('foot_2', 'foot_2', $data);
                $this->template->write_view('foot_3', 'foot_3', $data);
                // Render the template
                $this->template->render();
            }
        }
    }

    /**
     * Funzione per la conferma dell'inserimento cliente che non ha prenotato su 
     * una camera che era già prenotata
     */
    function conferma_inserisci_diretto() {
        // controllo che ci sia conferma
        
        
        //  trovo il valore se il conto è gia aperto 
          $data['controllo'] = $this->conti_model->rs_controllo_stato_conto($this->hotel_id, $this->input->get('camera_id'));
        
        
        if ($this->input->post('conferma') == 'Si') {

            $this->load->model('db_conti_model');

            $this->form_validation->set_rules('hotel_id', 'hotel_id', '');
            $this->form_validation->set_rules('foglio_id', 'foglio_id', '');
            $this->form_validation->set_rules('preno_dal', 'preno_dal', '');
            $this->form_validation->set_rules('in_conto_time', 'in_conto_time', '');
            $this->form_validation->set_rules('preno_al', 'preno_al', '');
            $this->form_validation->set_rules('camera_id', 'camera_id', '');
            $this->form_validation->set_rules('numero_camera', 'numero_camera', '');
            $this->form_validation->set_rules('trattamento_sog', 'trattamento_sog', '');
            $this->form_validation->set_rules('nome_tipologia', 'nome_tipologia', '');
            $this->form_validation->set_rules('tipologia_id', 'tipologia_id', '');
            $this->form_validation->set_rules('prezzo', 'prezzo', '');
            $this->form_validation->set_rules('nome', 'nome', 'trim|xss_clean');
            $this->form_validation->set_rules('cognome', 'cognome', 'required|trim|xss_clean');
            $this->form_validation->set_rules('preno_agenzia', 'preno_agenzia', '');
            $this->form_validation->set_rules('mercato', 'mercato', 'trim|xss_clean');
            $this->form_validation->set_rules('conti_stato_camere', 'conti_stato_camere', '');
            $this->form_validation->set_rules('conto_pag_modalita', 'conto_pag_modalita', 'trim|xss_clean');

            $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');

            if ($this->form_validation->run() == FALSE) {
                
                echo"Falso ";
                // $this->load->view('Ins_conti_view');
            } else {
                
                
          // // controllo che non ci sino conti aperti 
                    if(!$data['controllo']) {
                    // massimo Id dal Foglio    
                    $this->db->select_max('foglio_id');
                    $this->db->from('foglio_giorno');
                    $query = $this->db->get();
                    $result = $query->row();
                    $last_insert_id = $result->foglio_id;
                    $foglio_id = $last_insert_id + 1;
                    // max id Conti 
                    $this->db->select_max('conto_id');
                    $this->db->from('conti');
                    $query = $this->db->get();
                    $result = $query->row();
                    $last_insert_id = $result->conto_id;
                    $conto_id = $last_insert_id + 1;
                    // nome della tipologia 
                    // forse ho gia una classe nel model 
                    $this->db->select('tipologia_camera');
                    $this->db->from('camere');
                    $this->db->where('tipologia_id', $this->input->post('tipologia_id'));
                    $query = $this->db->get();
                    $result = $query->row();
                    $tipo_camera = $result->tipologia_camera;
                    // sql per inserire nei conti 
                    $form_data = array(
                        'conto_id' => $conto_id,
                        'hotel_id' => $this->input->post('hotel_id'),
                        'foglio_id' => $foglio_id,
                        'in_conto' => $this->input->post('preno_dal'),
                        'out_preno' => $this->input->post('preno_al'),
                        'in_conto_time' => $this->input->post('in_conto_time'),
                        'out_conto' => $this->input->post('out_conto'),
                        'preno_id' => $this->input->post('preno_id'),
                        'camera_id' => $this->input->post('camera_id'),
                        'numero_camera' => $this->input->post('numero_camera'),
                        'trattamento_sog' => $this->input->post('trattamento_sog'),
                        'tipo_camera' => $tipo_camera,
                        'tipologia_id' => $this->input->post('tipologia_id'),
                        'prezzo' => $this->input->post('prezzo'),
                        'nome_cliente' => $this->input->post('nome'),
                        'cognome_cliente' => $this->input->post('cognome'),
                        'preno_agenzia' => $this->input->post('preno_agenzia'),
                        'mercato' => $this->input->post('mercato'),
                        'conti_stato_camere' => $this->input->post('stato_camera'),
                        'acconto' => $this->input->post('acconto'),
                        'conto_pag_modalita' => $this->input->post('pagamento_modalita'),
                        'conti_utente_id' => $this->session->userdata('utente_id')
                    );

                    // isnerisco in conti
                    $this->db_conti_model->SaveForm($form_data);

                    $numero_camera = $this->camere_model->numero_camera($this->input->post('camera_id'));
                    // forse un doppione ?
                    $numero_camera = $numero_camera->numero_camera;
                  
                    // sql per inserire nel foglio  
                    $form_data_insert = array(
                        'conto_id' => $conto_id,
                        'foglio_id' => $foglio_id,
                        'hotel_id' => $this->input->post('hotel_id'),
                        'camera_id' => $this->input->post('camera_id'),
                        'preno_id' => $this->input->post('preno_id'),
                        'tipologia_id' => $this->input->post('tipologia_id'),
                        'numero_camera' => $numero_camera,
                        'foglio_prezzo_camera' => $this->input->post('prezzo'),
                        'nome_cliente' => $this->input->post('nome'),
                        'cognome_cliente' => $this->input->post('cognome'),
                        'in_conto' => $this->input->post('preno_dal'),
                        'out_preno' => $this->input->post('preno_al'),
                        'preno_agenzia' => $this->input->post('preno_agenzia'),
                        'stato_camera' => $this->input->post('stato_camera')
                    );
                    // inserisco una nota nel conto se non è nullo 
                    if (trim($this->input->post('conto_nota_testo')) != '') {

                        $array_insert = array('conto_nota_testo' => $this->input->post('conto_nota_testo'), 'conto_id' => $last_insert_id, 'hotel_id' => $this->hotel_id, 'note_conto_utente_id' => $this->utente_id);

                        $this->db->insert('conti_note', $array_insert);
                    }

                    // inserisco in foglio
                    $this->foglio_model->rs_insert_foglio($form_data_insert);

                    // se una camera era già assegna la libero
                    $this->foglio_model->cancella_camera_assegnata_id($this->hotel_id, $this->input->post('preno_dal'), $this->input->post('preno_al'), $this->input->post('camera_id'));
                    
                    echo"OK inserito  ". $conto_id ;
                    //redirect('foglio/');
                }
            }
        } else {
           //  redirect('foglio/');
            
            echo"Seleziona ";
        }
    }

    /**
     * fa il check out
     */
    function check_out() {
        $this->form_validation->set_rules('hotel_id', 'hotel_id', '');
        $this->form_validation->set_rules('preno_id', 'preno_id', '');
        $this->form_validation->set_rules('foglio_id', 'foglio_id', '');
        $this->form_validation->set_rules('camera_id', 'camera_id', '');
        $this->form_validation->set_rules('out_conto', 'out_conto', '');
        $this->form_validation->set_rules('cassa_utente_id', 'cassa_utente_id', '');
        $this->form_validation->set_rules('cassa_stato_camera', 'cassa_stato_camera', '');
        $this->form_validation->set_rules('totale_importo', 'totale_importo', '');
        $this->form_validation->set_rules('pagamento_importo_pag', 'pagamento_importo_pag', '');
        $this->form_validation->set_rules('pagamento_forma', 'pagamento_forma', '');

        $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');

        if ($this->form_validation->run() == FALSE) { // validation hasn't been passed
            $this->load->view('Ins_conti_view');
        } else { // passed validation proceed to post success logic
// build array for the model
            $form_data = array(
                'preno_id' => $this->input->post('preno_id'),
                'conto_id' => $this->input->post('conto_id'),
                'hotel_id' => $this->input->post('hotel_id'),
                'foglio_id' => $this->input->post('foglio_id'),
                'cassa_utente_id' => $this->input->post('cassa_utente_id'),
                'out_conto' => $this->input->post('out_conto'),
                'cassa_stato_camera' => $this->input->post('cassa_stato_camera'),
                'totale_importo' => $this->input->post('totale_importo'),
                'totale_modificato' => $this->input->post('totale_modificato'),
                'pagamento_importo_pag' => $this->input->post('pagamento_importo_pag'),
                'pagamento_forma' => $this->input->post('pagamento_forma')
            );

            // inserisce nel conto il check out
            $this->conti_model->check_out($form_data);

            redirect('conti/conti_partenza?conto_id=' . $this->input->post('conto_id'));
        }
    }

}

?>