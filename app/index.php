<?php

declare(strict_types=1);

namespace App;


require_once __DIR__ . "/../vendor/autoload.php";
define("VIEW_PATH", __DIR__ . "/views");

$dotenv = \Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$router = new Router();
$router
  ->get("/", [\App\Controller\HomeController::class, "index"])
  ->get("/login", [\App\Controller\AuthenticateController::class, "index"])
  ->post("/login", [\App\Controller\AuthenticateController::class, "login"])
  ->post("/signup", [\App\Controller\AuthenticateController::class, "signup"])
  ->get("/menu", [\App\Controller\MenuController::class, "index"])
  ->get("/menu/all", [\App\Controller\MenuController::class, "readAllMenus"])
  ->post("/menu/new", [\App\Controller\MenuController::class, "createMenu"])
  ->post("/menu/category/new", [\App\Controller\MenuController::class, "createCategory"])
  ->post("/menu/category/type/new", [\App\Controller\MenuController::class, "createType"])
  ->get("/admin/login", [\App\Controller\AdminController::class, "getAdminLoginView"])
  //product
  ->get("/product/type/id", [\App\Controller\ProductController::class, "getAllProducts"]) //Solved
  ->get("/product/id", [\App\Controller\ProductController::class, "getProductById"]) //Solved
  ->post("/product/new", [\App\Controller\ProductController::class, "createProductByTypeId"]) //Solved
  ->post("/product/update", [\App\Controller\ProductController::class, "updateProductById"]) //Solved
  ->post("/product/delete", [\App\Controller\ProductController::class, "deleteProductById"]) //Solved
  //serve
  ->get("/serve/productid", [\App\Controller\ServeController::class, "getAllServesByProductId"]) //Solved
  ->get("/serve/id", [\App\Controller\ServeController::class, "getServeById"]) //Solved
  ->post("/serve/new", [\App\Controller\ServeController::class, "createServeByProductId"]) //Solved
  ->post("/serve/update", [\App\Controller\ServeController::class, "updateServeById"]) //Solved
  ->post("/serve/delete", [\App\Controller\ServeController::class, "deleteServeById"]) //Solved
  //order
  ->get("/order/userid", [\App\Controller\OrderController::class, "getOrderByUserId"])
  ->post("/order/new", [\App\Controller\OrderController::class, "createOrderByUserId"])
  ->post("/order/update", [\App\Controller\OrderController::class, "updateOrderByUserId"])
  ->post("/order/delete", [\App\Controller\OrderController::class, "deleteOrderByUserId"])
  //order_product
  // ->get("order_product/orderid", [\App\Controller\OrderProductController::class, "getOrderProductByOrderId"])
  // ->post("order_product/orderid/new", [\App\Controller\OrderProductController::class, "createOrderProductByOrderId"])
  // ->post("order_product/orderid/update", [\App\Controller\OrderProductController::class, "updateOrderProductByOrderId"])
  // ->post("order_product/orderid/delete", [\App\Controller\OrderProductController::class, "deleteOrderProductByOrderId"])

  ->get("/admin", [\App\Controller\AdminController::class, "index"])
  ->post("/admin/login", [\App\Controller\AdminController::class, "login"])

  ->get("/admin/users", [\App\Controller\AdminController::class, "getAdminUsersView"])
  ->get("/admin/users/id", [\App\Controller\AdminController::class, "getUserByUserId"])
  ->post("/admin/users/update/id", [\App\Controller\AdminController::class, "updateUserByUserId"])
  ->post("/admin/users/delete/id", [\App\Controller\AdminController::class, "deleteUserByUserId"])
  ->get("/admin/users/list", [\App\Controller\AdminController::class, "getUserForOnePage"])
  ->get("/admin/users/total", [\App\Controller\AdminController::class, "getNumberOfUsers"])
  ->get("/admin/users/pages/total", [\App\Controller\AdminController::class, "getNumberOfUserPages"])
  ->get("/admin/users/members/total", [\App\Controller\AdminController::class, "getNumberOfMembers"])
  ->get("/admin/users/active/total", [\App\Controller\AdminController::class, "getNumberOfActiveUsers"])
  ->post("/admin/users/new", [\App\Controller\AdminController::class, "createUser"])

  ->get("/admin/menus", [\App\Controller\AdminController::class, "getAdminMenusView"])
  ->get("/admin/menus/total", [\App\Controller\AdminController::class, "getNumberOfMenus"])
  ->post("/admin/menus/new", [\App\Controller\AdminController::class, "createMenu"])
  ->get("/admin/menus/list", [\App\Controller\AdminController::class, "getMenuForOnePage"])
  ->post("/admin/menus/update/id", [\App\Controller\AdminController::class, "updateMenuByMenuId"])
  ->post("/admin/menus/delete/id", [\App\Controller\AdminController::class, "deleteMenuByMenuId"])
  ->get("/admin/menus/pages/total", [\App\Controller\AdminController::class, "getNumberOfMenuPages"])

  ->get("/admin/categories", [\App\Controller\AdminController::class, "getAdminCategoriesView"])
  ->post("/admin/categories/new", [\App\Controller\AdminController::class, "createCategory"])
  ->post("/admin/categories/update/id", [\App\Controller\AdminController::class, "updateCategoryByCategoryId"])
  ->post("/admin/categories/delete/id", [\App\Controller\AdminController::class, "deleteCategoryByCategoryId"])
  ->get("/admin/categories/list", [\App\Controller\AdminController::class, "getCategoryForOnePage"])
  ->get("/admin/categories/pages/total", [\App\Controller\AdminController::class, "getNumberOfCategoryPages"])
  ->get("/admin/categories/total", [\App\Controller\AdminController::class, "getNumberOfCategories"])

  ->get("/admin/types", [\App\Controller\AdminController::class, "getAdminTypesView"])
  ->get("/admin/types/total", [\App\Controller\AdminController::class, "getNumberOfTypes"])
  ->get("/admin/types/pages/total", [\App\Controller\AdminController::class, "getNumberOfTypePages"])
  ->get("/admin/types/list", [\App\Controller\AdminController::class, "getTypeForOnePage"])
  ->post("/admin/types/new", [\App\Controller\AdminController::class, "createType"])
  ->post("/admin/types/update/id", [\App\Controller\AdminController::class, "updateTypeByTypeId"])
  ->post("/admin/types/delete/id", [\App\Controller\AdminController::class, "deleteTypeByTypeId"])

  ->get("/admin/products", [\App\Controller\AdminController::class, "getAdminProductsView"])
  ->post("/admin/products/new", [\App\Controller\AdminController::class, "createProduct"])
  ->get("/admin/products/list", [\App\Controller\AdminController::class, "getProductForOnePage"])
  ->get("/admin/products/total", [\App\Controller\AdminController::class, "getNumberOfProducts"])
  ->get("/admin/products/pages/total", [\App\Controller\AdminController::class, "getNumberOfProductPages"])
  ->post("/admin/products/update/id", [\App\Controller\AdminController::class, "updateProductByProductId"])
  ->post("/admin/products/delete/id", [\App\Controller\AdminController::class, "deleteProductByProductId"])
  ;
  
$config = new Configuration($_ENV);

$app = App::make(
  $router,
  [
    "uri" => $_SERVER["REQUEST_URI"],
    "method" => strtolower($_SERVER["REQUEST_METHOD"])
  ],
  $config
);

$app->run();

?>