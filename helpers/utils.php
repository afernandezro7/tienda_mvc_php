<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of utils
 *
 * @author alberto
 */
class Utils {

    public static function deleteSession($name): void {

        if (isset($_SESSION[$name])) {
            $_SESSION[$name] = null;
            unset($_SESSION[$name]);
        }
    }

    public static function showError($errors, $field) {
        $alerta = '';
        if (isset($errors[$field]) && !empty($field)) {
            $alerta = "<strong class='alert_red'>" . $errors[$field] . "</strong>";
        }

        return $alerta;
    }

    public static function isAdmin() {

        if (!isset($_SESSION['admin'])) {
            header('Location: ' . base_url);
        } else {
            return true;
        }
    }

    public static function isLogged() {

        if (!isset($_SESSION['identity'])) {
            header('Location: ' . base_url);
        } else {
            return true;
        }
    }

    public static function showCategories() {
        require_once 'models/categoria.php';
        $categoria = new Categoria();
        $categorias = $categoria->getAll();
        return $categorias;
    }

    public static function showProducts() {
        require_once 'models/producto.php';
        $producto = new Producto();
        $productos = $producto->getAll();
        return $productos;
    }

    public static function carStats() {
        $stats = array(
            'count' => 0,
            'total' => 0
        );
        if (isset($_SESSION['carrito'])) {

            foreach ($_SESSION['carrito'] as $indice => $producto) {
                $stats['count'] += $producto['unidades'];
                $stats['total'] += $producto['precio'] * $producto['unidades'];
            }
        }
        return $stats;
    }

    public static function renderProduct($prod, $prod_detail = false) {

        if ($prod_detail) {
            //Render product detail

            $html = "<div id='detail-product'>";
            $html .= "<div class='image'>";
            if (empty($prod->imagen)) {
                $html .= "<img src='" . base_url . "assets/img/no-image.png' alt='" . $prod->nombre . "'/>";
            } else {
                $html .= "<img src='" . base_url . "uploads/images/" . $prod->imagen . "' alt='" . $prod->nombre . "'/>";
            }
            $html .= "</div>";
            $html .= "<div class='data'>";
            $html .= "<p class='description'>$prod->descripcion</p>";
            $html .= "<p class='price'>$ $prod->precio </p>";
            $html .= "<a href='" . base_url . "carrito/add&id=" . $prod->id . "' class='button'>Comprar</a>";
            $html .= "</div>";
            $html .= "</div>";
        } else {
            //Render product thumb

            $html = "<div class='product'>";
            $html .= "<a href='" . base_url . "producto/ver&id=" . $prod->id . "'>";
            if (empty($prod->imagen)) {
                $html .= "<img src='" . base_url . "assets/img/no-image.png' alt='" . $prod->nombre . "'/>";
            } else {
                $html .= "<img src='" . base_url . "uploads/images/" . $prod->imagen . "' alt='" . $prod->nombre . "'/>";
            }
            $html .= "<h2>$prod->nombre</h2>";
            $html .= "</a>";
            $html .= "<p>$ $prod->precio</p>";
            $html .= "<a href='" . base_url . "carrito/add&id=" . $prod->id . "' class='button'>Comprar</a>";
            $html .= "</div>";
        }

        return $html;
    }

    public static function showState($state) {
        switch ($state) {
            case 'confirm':
                return 'Pendiente de Pago';
                break;
            case 'preparation':
                return 'En Preparación';
                break;
            case 'ready':
                return 'Listo para enviar';
                break;
            case 'sent':
                return 'Enviado';
                break;
            case 'canceled':
                return 'Cancelado';
                break;
            default:
                return 'En Preparación';
                break;
        }
    }

}
