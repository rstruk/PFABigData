<!DOCTYPE html>
<html lang="fr" ng-app="turtleApp">
    <head>
        <meta charset="utf-8">
        <title>Turtle</title>
        <base href="/work/eirb/PFABigData/">
        <link rel="stylesheet" href="CodeMirror-master/lib/codemirror.css">
        <link rel="stylesheet" href="CodeMirror-master/addon/hint/show-hint.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <style>
            .CodeMirror {
                position: absolute;
                top: 0;
                bottom: 0;
                right: 0;
                left: 50%;
            }
            .PDF {
                position: absolute;
                top: 0;
                bottom: 0;
                left: 0;
                right: 50%;
            }
            .PDF iframe {
                border: none;
                margin: 0;
                padding: 0;
                width: 100%;
                height: 100%;
            }
        </style>
        <script src="CodeMirror-master/lib/codemirror.js"></script>
        <script src="CodeMirror-master/addon/hint/show-hint.js"></script>
        <script src="CodeMirror-master/addon/hint/anyword-hint.js"></script>
        <script src="CodeMirror-master/mode/turtle/turtle.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular-route.min.js"></script>
        <script>
            var turtleApp = angular.module('turtleApp', [ 'ngRoute' ]);
            turtleApp.value('file', {
                    pdfUrl: null,
                    filename: null,
                    author: null,
                    topic: null,
                    text: null,
            });
            turtleApp.controller('LoaderCtrl',
                function($scope, $location, file) {
                    $scope.file = file;
                    $scope.loadEditor = function(file) {
                        $scope.file = file;
                        $location.url('/editor');
                    };
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
                    CodeMirror.fromTextArea(
                        document.getElementById("text"),
                        {
                            mode: {
                                name: 'turtle',
                                globalVars: true
                            },
                            extraKeys: {
                                'Ctrl-Space': 'autocomplete',
                                'Ctrl-N': function(editor) {
                                    alert(
                                        'Aide : Raccourci clavier\n' +
                                        'Ctrl-Space : Autocompletion\n' +
                                        'Ctrl-M : Sauvegarde\n' +
                                        'Ctrl-A : Selectionner tout\n' +
                                        'Ctrl-C : Copier\n' +
                                        'Ctrl-V : Coller\n' +
                                        'Ctrl-X : Couper'
                                    );
                                },
                                'Ctrl-M': function(editor) {
                                    // TODO save with PHP
                                }
                            },
                            lineNumbers: true,
                            lineWrapping: true,
                            matchBrackets: true
                        }
                    );
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
    </head>
    <body>
        <div ng-view></div>
    </body>
</html>
