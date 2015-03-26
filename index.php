<!DOCTYPE html>
<html lang="fr" ng-app="turtleApp">
    <head>
        <meta charset="utf-8">
        <title>Turtle</title>
        <base href="/work/eirb/PFABigData/">
        <link rel="stylesheet" href="CodeMirror-master/lib/codemirror.css">
        <link rel="stylesheet" href="CodeMirror-master/addon/hint/show-hint.css">
        <link rel="stylesheet" href="style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular-route.min.js"></script>
        <script>
            var turtleApp = angular.module('turtleApp', [ 'ngRoute' ]);
            turtleApp.value('file', {
                    pdfUrl: null,
                    filename: null,
                    author: null,
                    topic: null,
            });
            turtleApp.controller('LoaderCtrl',
                function($scope, $location, file) {
                    $scope.file = file;
                    $scope.loadEditor = function() {
                        $location.url('/editor');
                    }
                }
            );
            turtleApp.controller('EditorCtrl',
                function($scope, $location, file) {
                    if (file.pdfUrl === null ||
                        file.filename === null ||
                        file.author === null ||
                        file.topic === null)
                        return $location.url('/loader');
                    $scope.file = file;
                }
            );
            turtleApp.config([ '$routeProvider', '$locationProvider',
                function($routeProvider, $locationProvider) {
                    $routeProvider.
                        when('/loader', {
                            templateUrl: 'partials/loader.html',
                            controller: 'LoaderCtrl',
                        }).
                        when('/editor', {
                            templateUrl: 'partials/editor.html',
                            controller: 'EditorCtrl',
                        }).
                        otherwise({
                            redirectTo: '/loader',
                        });
                }
            ]);
        </script>
        <script src="CodeMirror-master/lib/codemirror.js"></script>
        <script src="CodeMirror-master/addon/hint/show-hint.js"></script>
        <script src="CodeMirror-master/addon/hint/anyword-hint.js"></script>
        <script src="CodeMirror-master/mode/turtle/turtle.js"></script>
    </head>
    <body>
        <div ng-view></div>
    </body>
</html>
