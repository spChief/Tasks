;(function($, window, undefined) {
    /**
     * =================================================================================================================
     * DOM Ready
     * =================================================================================================================
     */
    $(function(){
        $('body').frontController();
    });

    /**
     * =================================================================================================================
     * Controllers (Plugins)
     * =================================================================================================================
     */

    /**
     * Registry
     */
    $.Class('Application.Registry',
        {
            registry: {
            },

            set: function(name, value){
                this.registry[name] = value;
            },

            get: function(name){
                return this.registry[name];
            }
        },
        {
        }
    );

    /**
     * Bootstrap
     */
    $.Class('Application.Bootstrap',
        {
            tasks: {
            }
        },
        {
            init: function(){
            },

            startTask: function(taskName){
                var tasks = this.constructor.tasks;
                if (typeof taskName !== 'undefined' && $.isFunction(tasks[taskName])) {
                    tasks[taskName]();
                }
            },

            startTasks: function(){
                var tasks = this.constructor.tasks;
                for (var task in tasks) {
                    this.startTask(task);
                }
            }
        }
    );

    /**
     * Front controller
     */
    $.Controller('Application.Controller.Front',
        {
            pluginName: 'frontController'
        },
        {
            /**
             * ---------------
             * Bootstrap
             * ---------------
             */
            init: function(){
                // Store self instance
                Application.Registry.set('frontController', this);

                // Start Bootstrap
                var bootstrap = new Application.Bootstrap();
                Application.Registry.set('bootstrap', bootstrap);
                bootstrap.startTasks();
            }
        }
    );

})(jQuery, window);
