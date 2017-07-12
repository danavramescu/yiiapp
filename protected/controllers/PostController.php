<?
class PostController extends Controller 
{
    public function actionCreate(array $categories)
    {
       // ... fun code starts here ... By doing so, if $_GET['categories'] is a simple string, it will be converted into an array consisting of that string.
    }

    public function filters()
    {
        return array(
            'postOnly + edit, create',
            array(
                'application.filters.PerformanceFilter - edit, create',
                'unit'=>'second',
            ),
        );
    }
}
?>