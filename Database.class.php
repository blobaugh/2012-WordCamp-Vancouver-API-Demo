<?php
/**
 * Mysqli database connector
 *
 * *********************************
 * TODO:
 *      Make Insert, Update, Delete, InsertUpdate, Etc check to make sure columns and tables exist first
 **/

/**
 * Singleton. Use Database->GetDatabase
 **/
class Database {

	/**
	* Holds whether an instance exists already or not.
	*
	* @var Boolean
	*/
	private static $Exists = FALSE;

	/**
	 * The mysqli connection
	 *
	 * @var mysqli
	 */
	private $mConnection;

        /**
	 * @var Array - Holds strings of all queries made, both successful and not
	 */
	private $mQueries;
	/**
	 * @var Integer - Total number of queries executed
	 */
	private $mNumQueries;
	/**
	 * @var Integer - Total number of failed queries
	 */
	private $mNumFailedQueries;

        /*
         * Private constructor
         *
         * Creates connections
         */
        public function __construct( $dblocation, $dbuser, $dbpass, $dbname ) {
                

                $this->mConnection = new mysqli( $dblocation, $dbuser, $dbpass, $dbname );

                // Setup some defaults
                $this->mQueries = array();
                $this->mNumQueries = 0;
                $this->mNumFailedQueries = 0;
                $this->mErrors = array();
        }

	public function Query($Sql) {
	        // Perform some statistics
	        $this->IncQueryCount();
	        $this->AddQuery($Sql);

	        return $this->mConnection->query($Sql);
	}


        /*********************************************************
        **** PUBLIC VERSIONS OF INTERNAL FUNCTIONS
        *********************************************************/

        /**
         * Displays all run queries
         **/
         public function ShowQueries() {
                new dBug($this->mQueries);
         }
        /*********************************************************
        **** INTERNAL DATABASE FUNCTIONS
        *********************************************************/

        /**
         * Increment total number of queries run
         */
        private function IncQueryCount() {
                $this->mNumQueries++;
        }

        /**
         * Return number of queries run on page
         *
         * @return Integer
         **/
         public function GetQueryCount() {
                return $this->mNumQueries;
         }

         /**
          * Make a string safe for the database
          *
          * @return String
          **/
         public function EscapeString($String) {
                return $this->mConnection->real_escape_string($String);
         }

        /**
         * Add query to keep track of all queries run
         * If the query had an error mark in here
         *
         * @param String $Sql
         * @param Boolean $Error - default false
         */
         private function AddQuery($Sql, $Error = false) {
                $success = '<font color="green">';
                $failed = '<font color="red">';
                $close = '</font>';

                $s = ($Error)? $failed : $success;

                $s .= $Sql . $close;

                $this->mQueries[] = $s;
         }

} // end class
