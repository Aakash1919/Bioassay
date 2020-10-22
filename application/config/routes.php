<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['quickstrips'] = 'home/quickstrips';

$route['analytical-services'] = 'services/analytical_services';
$route['assay-customization'] = 'services/assay_customization';
$route['assay-design-and-development'] = 'services/assay_design_and_development';
$route['lead-discovery-services'] = 'services/lead_discovery_services';

$route['product-citations'] = 'support/product_citations';
$route['general-questions'] = 'support/general_questions';
$route['training-videos'] = 'support/training_videos';
$route['admin'] = '/login';

$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;

//$route['products/(:any)'] = 'products/details/$1';

$route['(:any)'] = function($slug)
{
    // find out which class(controller)/method to execute.
    $validated = $this->_validate_request( array_values($this->uri->segments) );
    
    // cleanup. (which set by _validate_request())
    $directory = $this->directory;
    $this->directory = NULL;

    // extract class(controller) & method name.
    if(array_key_exists(0,$validated))
    {
        // class(controller) name found.
        $class_name = ucfirst($validated[0]);
    }
    else
    {
        // class(controller) name not found. route to desired controller.
        return 'products/details/'.$slug;
    }
    $method_name = array_key_exists(1,$validated) ? $validated[1] : 'index';
    
    // class(controller) file to load.
    $class_path = APPPATH.'controllers/'. $directory . $class_name . '.php';
    
    // cleanup. (which set by _validate_request())
    $this->directory = NULL;
    
    // class(controller) exists?
    if(file_exists($class_path))
    {
        // load CI_Controller core class and our class(controller).
        include_once(FCPATH.'system/core/Controller.php');
        include_once($class_path);
        
        // does method exists?
        if(method_exists($class_name,$method_name))
        {
            // if class(controller) and method exists, we should execute it.
            return implode('/',$this->uri->segments);
        }
        else
        {
            // well, if not, it's time to route to desired controller.
            return 'products/details/'.$slug;
        }
    }
    else
    {
        // if class(controller) doesnt exists, route to desired controller.
        return 'products/details/'.$slug;
    }
}; 

