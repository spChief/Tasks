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
                initTaskList: function() {
                    $('.jsTaskList').taskList();
                }
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

    // controller for task list (window with controls and task list)
    $.Controller('Application.Controller.TaskList',
        {
            pluginName: 'taskList',
            defaults: {
                taskList: []
            }
        },
        {
            init: function() {
                this.initTasks();
            },

            // buttons handler
            '.jsButton click': function(obj, e) {

                switch ($(obj).data('action')) {
                    case 'minimize':
                        return this.minimize();
                    case 'maximize':
                        return this.maximize();
                    case 'close':
                        return this.close();
                    case 'addTask':
                        return this.addTask();
                    case 'deleteTask':
                        return this.deleteTask();
                    default:
                        return true;
                }
            },

            '.jsTask click': function(obj, e) {
                this.setActiveTask(obj);
            },

            // collect all task and apply controller to each
            initTasks: function() {
                var $tasks = $('.jsTask', this.element);

                $tasks.each(this.proxy(function(i, obj) {
                    this.options.taskList.push($(obj).task().controller());
                }));
            },

            setActiveTask: function(obj) {
                $('.jsTask', this.element).removeClass('selected');
                $(obj).addClass('selected');
                this.options.selectedTask = $(obj);
            },

            minimize: function() {
                return true;
            },

            maximize: function() {
                return true;
            },

            close: function() {
                return true;
            },

            addTask: function() {
                return true;
            },

            deleteTask: function() {
                if (!this.options.selectedTask) {
                    alert('Сначала выберите задачу из списка');
                    return false;
                }
                this.options.selectedTask.controller().delete();
                return true;
            }
        }
    );

    // controller for single task
    $.Controller('Application.Controller.Task',
        {
            pluginName: 'task',
            defaults: {
                data: {},
                titleKeyupTimeout: 500,
                titleKeyupTimeoutId: false
            }
        },
        {
            init: function() {
                this.parseData();
            },

            '.jsCheckDone change': function(obj, e) {

                this.toggleDone($(obj).is(':checked'));
            },

            // title change handler
            '.jsTitle keyup': function(obj, e) {
                var timeout = this.options.titleKeyupTimeoutId;

                if (timeout) {
                    clearTimeout(timeout);
                }

                this.options.titleKeyupTimeoutId = setTimeout(this.proxy(function() {
                    this.updateTitle($(obj).text());
                }), this.options.titleKeyupTimeout);
            },

            // collect data for task from html
            parseData: function() {
                var data = this.options.data;

                data.id = this.element.data('id');
                data.done = this.element.hasClass('checked');
                data.title = $('.jsTitle', this.element).text();
            },

            toggleDone: function(done) {

                this.element.toggleClass('done', done);
                this.options.data.done = done ? 1 : 0;

                this.save();
            },

            updateTitle: function(title) {

                this.options.data.title = title;
                this.save();
            },

            // send current data to server
            save: function(callback) {

                $.post(
                    URL_TASK_SAVE,
                    this.options.data,
                    this.proxy(function (response) {
                        if (response.status) {
                            this.options.data = response.data;
                            if (typeof callback == 'function') {
                                callback(response.data);
                            }
                        } else {
                            alert(response.message);
                        }
                    })
                );
            },

            // delete task from document and server
            delete: function() {

                this.element.remove();

                $.post(
                    URL_TASK_DESTROY,
                    { id: this.options.data.id },
                    this.proxy(function(response) {
                        if (!response.status) {
                            alert(response.message);
                        }
                    })
                );
            }
        }
    );

})(jQuery, window);
