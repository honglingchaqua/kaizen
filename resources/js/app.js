/**
* Theme: Konrix - Responsive Tailwind Admin Dashboard
* Author: coderthemes
* Module/App: App js
*/

import "@frostui/tailwindcss";
import feather from 'feather-icons';

class App {
    // Components
    initComponents() {
        // Feather Icons
        feather.replace();

        // Back To Top
        const mybutton = document.querySelector('[data-toggle="back-to-top"]');

        window.addEventListener('scroll', function () {
            if (window.pageYOffset > 72) {
                mybutton.classList.add('flex');
                mybutton.classList.remove('hidden');
            } else {
                mybutton.classList.remove('flex');
                mybutton.classList.add('hidden');
            }
        });

        mybutton.addEventListener('click', function (e) {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    // Topbar Fullscreen Button
    initfullScreenListener() {
        var fullScreenBtn = document.querySelector('[data-toggle="fullscreen"]');

        if (fullScreenBtn) {
            fullScreenBtn.addEventListener('click', function (e) {
                e.preventDefault();
                document.body.classList.toggle('fullscreen-enable');
                if (!document.fullscreenElement && !document.mozFullScreenElement && !document.webkitFullscreenElement) {
                    if (document.documentElement.requestFullscreen) {
                        document.documentElement.requestFullscreen();
                    } else if (document.documentElement.mozRequestFullScreen) {
                        document.documentElement.mozRequestFullScreen();
                    } else if (document.documentElement.webkitRequestFullscreen) {
                        document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
                    }
                } else {
                    if (document.exitFullscreen) {
                        document.exitFullscreen();
                    } else if (document.mozCancelFullScreen) {
                        document.mozCancelFullScreen();
                    } else if (document.webkitExitFullscreen) {
                        document.webkitExitFullscreen();
                    }
                }
            });
        }
    }

    init() {
        this.initComponents();
        this.initfullScreenListener();
    }
}

class ThemeCustomizer {
    constructor() {
        this.html = document.getElementsByTagName('html')[0];
        this.config = {};
        this.defaultConfig = window.config;
        this.sidebarHoverTimeout = null;
    }

    initConfig() {
        this.defaultConfig = JSON.parse(JSON.stringify(window.defaultConfig));
        this.config = JSON.parse(JSON.stringify(window.config));
        this.setSwitchFromConfig();
        this.initHiddenSidebar();
    }

    initSidenav() {
        var self = this;
        var pageUrl = window.location.href.split(/[?#]/)[0];
        document.querySelectorAll('ul.menu a.menu-link').forEach((element) => {
            if (element.href === pageUrl) {
                element.classList.add('active');
                let parentMenu = element.parentElement.parentElement.parentElement;
                if (parentMenu && parentMenu.classList.contains('menu-item')) {
                    const collapseElement = parentMenu.querySelector('[data-fc-type="collapse"]');
                    if (collapseElement && frost != null) {
                        const collapse = frost.Collapse.getInstanceOrCreate(collapseElement);
                        collapse.show();
                    }
                }
            }
        });

        setTimeout(function () {
            var activatedItem = document.querySelector('ul.menu .active');
            if (activatedItem != null) {
                var simplebarContent = document.querySelector('.app-menu .simplebar-content-wrapper');
                var offset = activatedItem.offsetTop - 300;
                if (simplebarContent && offset > 100) {
                    scrollTo(simplebarContent, offset, 600);
                }
            }
        }, 200);

        function easeInOutQuad(t, b, c, d) {
            t /= d / 2;
            if (t < 1) return c / 2 * t * t + b;
            t--;
            return -c / 2 * (t * (t - 2) - 1) + b;
        }

        function scrollTo(element, to, duration) {
            var start = element.scrollTop, change = to - start, currentTime = 0, increment = 20;
            var animateScroll = function () {
                currentTime += increment;
                var val = easeInOutQuad(currentTime, start, change, duration);
                element.scrollTop = val;
                if (currentTime < duration) {
                    setTimeout(animateScroll, increment);
                }
            };
            animateScroll();
        }
    }

    reverseQuery(element, query) {
        while (element) {
            if (element.parentElement) {
                if (element.parentElement.querySelector(query) === element) return element;
            }
            element = element.parentElement;
        }
        return null;
    }

    changeThemeDirection(direction) {
        this.config.direction = direction;
        this.html.setAttribute('dir', direction);
        this.setSwitchFromConfig();
    }

    changeThemeMode(color) {
        this.config.theme = color;
        this.html.setAttribute('data-mode', color);
        this.setSwitchFromConfig();
    }

    changeLayoutWidth(width, save = true) {
        this.html.setAttribute('data-layout-width', width);
        if (save) {
            this.config.layout.width = width;
            this.setSwitchFromConfig();
        }
    }

    changeLayoutPosition(position, save = true) {
        this.html.setAttribute('data-layout-position', position);
        if (save) {
            this.config.layout.position = position;
            this.setSwitchFromConfig();
        }
    }

    changeTopbarColor(color) {
        this.config.topbar.color = color;
        this.html.setAttribute('data-topbar-color', color);
        this.setSwitchFromConfig();
    }

    changeMenuColor(color) {
        this.config.menu.color = color;
        this.html.setAttribute('data-menu-color', color);
        this.setSwitchFromConfig();
    }

    changeSidenavView(view, save = true) {
        this.html.setAttribute('data-sidenav-view', view);
        if (save) {
            this.config.sidenav.view = view;
            this.setSwitchFromConfig();
        }
    }

    resetTheme() {
        this.config = JSON.parse(JSON.stringify(window.defaultConfig));
        this.changeThemeDirection(this.config.direction);
        this.changeThemeMode(this.config.theme);
        this.changeLayoutWidth(this.config.layout.width);
        this.changeLayoutPosition(this.config.layout.position);
        this.changeTopbarColor(this.config.topbar.color);
        this.changeMenuColor(this.config.menu.color);
        this.changeSidenavView(this.config.sidenav.view);
        this.adjustLayout();
    }

    initSwitchListener() {
        var self = this;

        document.querySelectorAll('input[name=dir]').forEach(function (element) {
            element.addEventListener('change', function (e) {
                self.changeThemeDirection(element.value);
            });
        });

        document.querySelectorAll('input[name=data-mode]').forEach(function (element) {
            element.addEventListener('change', function (e) {
                self.changeThemeMode(element.value);
            });
        });

        document.querySelectorAll('input[name=data-layout-width]').forEach(function (element) {
            element.addEventListener('change', function (e) {
                self.changeLayoutWidth(element.value);
            });
        });

        document.querySelectorAll('input[name=data-layout-position]').forEach(function (element) {
            element.addEventListener('change', function (e) {
                self.changeLayoutPosition(element.value);
            });
        });

        document.querySelectorAll('input[name=data-topbar-color]').forEach(function (element) {
            element.addEventListener('change', function (e) {
                self.changeTopbarColor(element.value);
            });
        });

        document.querySelectorAll('input[name=data-menu-color]').forEach(function (element) {
            element.addEventListener('change', function (e) {
                self.changeMenuColor(element.value);
            });
        });

        document.querySelectorAll('input[name=data-sidenav-view]').forEach(function (element) {
            element.addEventListener('change', function (e) {
                self.changeSidenavView(element.value);
            });
        });

        // Light Dark Button
        var themeColorToggle = document.getElementById('light-dark-mode');
        if (themeColorToggle) {
            themeColorToggle.addEventListener('click', function (e) {
                if (self.config.theme === 'light') {
                    self.changeThemeMode('dark');
                } else {
                    self.changeThemeMode('light');
                }
            });
        }

        // Menu Toggle Button (Placed in Topbar)
        var menuToggleBtn = document.querySelector('#button-toggle-menu');
        if (menuToggleBtn) {
            menuToggleBtn.addEventListener('click', function () {
                var configView = self.config.sidenav.view;
                var view = self.html.getAttribute('data-sidenav-view', configView);

                if (view === 'mobile') {
                    self.showBackdrop();
                    self.html.classList.toggle('sidenav-enable');
                } else {
                    if (configView == 'hidden') {
                        if (view === 'hidden') {
                            self.changeSidenavView(configView == 'hidden' ? 'default' : configView, false);
                        } else {
                            self.changeSidenavView('hidden', false);
                        }
                    } else {
                        if (view === 'sm') {
                            self.changeSidenavView(configView == 'sm' ? 'default' : configView, false);
                        } else {
                            self.changeSidenavView('sm', false);
                        }
                    }
                }
            });
        }

        // Close on Backdrop Click
        var backdrop = document.querySelector('.backdrop');
        if (backdrop) {
            backdrop.addEventListener('click', function () {
                self.html.classList.remove('sidenav-enable');
                self.hideBackdrop();
            });
        }
    }

    showBackdrop() {
        const backdrop = document.createElement('div');
        backdrop.classList.add('backdrop');
        document.body.appendChild(backdrop);
    }

    hideBackdrop() {
        const backdrop = document.querySelector('.backdrop');
        if (backdrop) {
            document.body.removeChild(backdrop);
        }
    }

    adjustLayout() {
        var layoutWidth = this.config.layout.width;
        var layoutPosition = this.config.layout.position;
        var sidenavView = this.config.sidenav.view;

        this.html.setAttribute('data-layout-width', layoutWidth);
        this.html.setAttribute('data-layout-position', layoutPosition);
        this.html.setAttribute('data-sidenav-view', sidenavView);
    }

    initHiddenSidebar() {
        const self = this;
        const sidenav = document.querySelector('.app-sidenav');
        if (sidenav) {
            let mouseOver = false;
            sidenav.addEventListener('mouseover', () => {
                mouseOver = true;
                self.html.classList.add('sidenav-enable');
                clearTimeout(self.sidebarHoverTimeout);
            });

            sidenav.addEventListener('mouseout', () => {
                mouseOver = false;
                self.sidebarHoverTimeout = setTimeout(() => {
                    self.html.classList.remove('sidenav-enable');
                }, 2000);
            });

            // For smooth hiding and showing of the sidebar on hover
            document.querySelector('.app-content').addEventListener('mouseover', () => {
                mouseOver = true;
                self.html.classList.add('sidenav-enable');
                clearTimeout(self.sidebarHoverTimeout);
            });

            document.querySelector('.app-content').addEventListener('mouseout', () => {
                mouseOver = false;
                self.sidebarHoverTimeout = setTimeout(() => {
                    if (!mouseOver) {
                        self.html.classList.remove('sidenav-enable');
                    }
                }, 2000);
            });
        }
    }

    setSwitchFromConfig() {
        this.html.setAttribute('data-direction', this.config.direction);
        this.html.setAttribute('data-mode', this.config.theme);
        this.html.setAttribute('data-layout-width', this.config.layout.width);
        this.html.setAttribute('data-layout-position', this.config.layout.position);
        this.html.setAttribute('data-topbar-color', this.config.topbar.color);
        this.html.setAttribute('data-menu-color', this.config.menu.color);
        this.html.setAttribute('data-sidenav-view', this.config.sidenav.view);

        this.adjustLayout();
    }

    initSidebar() {
        this.initSidenav();
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const app = new App();
    const themeCustomizer = new ThemeCustomizer();

    app.init();
    themeCustomizer.initConfig();
    themeCustomizer.initSidebar();
    themeCustomizer.initSwitchListener();
});
