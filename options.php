<?php
    // $Id$
    
    if (!defined('SIMPLE_TEST')) {
        define('SIMPLE_TEST', './');
    }
    
    /**
     *    Static global directives and options.
     */
    class SimpleTestOptions {
        
        /**
         *    Does nothing.
         */
        function SimpleTestOptions() {
        }
        
        /**
         *    Sets the name of a test case to ignore, usually
         *    because the class is an abstract case that should
         *    not be run.
         *    @param $class        Add a class to ignore.
         *    @static
         *    @public
         */
        function ignore($class) {
            $registry = &SimpleTestOptions::_getRegistry();
            $registry['IgnoreList'][] = strtolower($class);
        }
        
        /**
         *    Test to see iif a test case is in the ignore
         *    list.
         *    @param $class        Class name to test.
         *    @return              True if should not be run.
         *    @public
         *    @static
         */
        function isIgnored($class) {
            $registry = &SimpleTestOptions::_getRegistry();
            return in_array(strtolower($class), $registry['IgnoreList']);
        }
        
        /**
         *    The base class name is settable here. This is the
         *    class that a new mock will inherited from.
         *    To modify the generated mocks simply extend the
         *    SimpleMock class and set it's name
         *    with this method before any mocks are generated.
         *    @param $mock_base        Mock base class to use.
         *    @static
         *    @public
         */
        function setMockBaseClass($mock_base) {
            $registry = &SimpleTestOptions::_getRegistry();
            $registry['MockBaseClass'] = $mock_base;
        }
        
        /**
         *    Accessor for the currently set mock base class.
         *    @return            Class name to inherit from.
         *    @static
         *    @public
         */
        function getMockBaseClass() {
            $registry = &SimpleTestOptions::_getRegistry();
            return $registry['MockBaseClass'];
        }
        
        /**
         *    Accessor for global registry of options.
         *    @return            Hash of stored values.
         *    @private
         *    @static
         */
        function &_getRegistry() {
            static $registry = false;
            if (!$registry) {
                $registry = SimpletestOptions::getDefaults();
            }
            return $registry;
        }
        
        /**
         *    Constant default values.
         *    @return        Hash of registry defaults.
         *    @public
         *    @static
         */
        function getDefaults() {
            return array(
                    'MockBaseClass' => 'SimpleMock',
                    'IgnoreList' => array());
        }
    }
?>