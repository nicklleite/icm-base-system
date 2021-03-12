<?php

/**
 * Contratos - Nepuga
 * 
 * @package Contratos
 * @author Nicholas Leite <nicklleite@gmail.com>
 * @copyright Nepuga Copyright (c) 2020-2020
 */

namespace App\Libraries;

/**
 * Lib para interações e procedimentos de envio e assinatura digital de
 * documentos. Essa classe possui mapeamento dos endpoints da API do
 * ClickSign, bem como identificadores de ambiente da API, seja
 * SANDBOX ou PRODUCTION.
 * 
 * @author Nicholas Leite <nicklleite@gmail.com>
 * @package Contrato\ClickSign
 * @version 0.2-20201106
 * @since 0.0
 */

class ClickSign {
    public function __construct() {

    }

    public static function upload() {

    }

    /**
     * 
     */
    private static function _get_service_url($service, $action, $data = array()) {

        if (!getenv('app.clickSignServices.' . $service . '.' . $action . '.endpoint')) {

        }


        // if ($service == "" || $action == "") {
        //     return json_encode([
        //         'error' => true,
        //         'message' => "Parâmetros inválidos"
        //     ]);
        // }

        // if (!array_key_exists($service, $this->availableServices) || !array_key_exists($action, $this->availableServices[$service])) {
        //     return json_encode([
        //         'error' => true,
        //         'message' => "Serviço ou Ação inválidos!"
        //     ]);
        // }

        // $baseUrl = "https://" . $this->env . "clicksign.com/api/" . $this->apiVersion;
        // $serviceInfo = $this->availableServices[$service][$action];

        // $serviceUrl = $baseUrl . $serviceInfo['endpoint'];
        // $serviceUrl = $this->_replace_on_string("access_token", $this->_get_access_token(), $serviceUrl);

        // if ($this->_search_on_string("key", $serviceUrl)) {
        //     if (count($data) > 0) {
        //         if (array_key_exists('doc', $data)) {
        //             $serviceUrl = $this->_replace_on_string("key", $data['doc'], $serviceUrl);
        //         }
        //     } else {
        //         return json_encode([
        //             "error" => true,
        //             "message" => "Dados não encontrados e(ou) inválidos!"
        //         ]);
        //     }
        // }

        // return json_encode([
        //     "error" => false,
        //     "url" => $serviceUrl,
        //     "method" => $serviceInfo['method']
        // ]);
    }

}