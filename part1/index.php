<?php

/**
 * Single point of entry. 
 * 
 * @author Alex Hakesley w16011419
 */

include 'config/config.php';
$request = new Request();
$requestPath = $request->getPath();
if (substr($requestPath, 0, 3) == "api") {
    $response = new JSONResponse();
} else {
    set_exception_handler('HTMLExceptionHandler');
    $response = new HTMLResponse();
}

switch ($requestPath) {
    case '':
    case 'home':
        $controller = new HomeController($request, $response);
        break;
    
    case 'documentation':
        $controller = new DocumentationController($request, $response);
        break;

    case 'api':
        $controller = new APIBaseController($request, $response);
        break;

    case 'api/authors':
        $controller = new APIAuthorController($request, $response);
        break;

    case 'api/papers':
        $controller = new ApiPaperController($request, $response);
        break;

    case 'api/authenticate':
        $controller = new ApiAuthenticateController($request, $response);
        break;

    case 'api/readinglist':
        $controller = new ApiReadingListController($request, $response);
        break;
        
    default:
        if (substr($requestPath, 0, 3) === "api") {
            $response->setStatusCode(404);
            $response->setMessage("Not found");
            break;
        } else {
            $controller = new ErrorPageController($request, $response);
            break;
        }

}

echo $response->getData();