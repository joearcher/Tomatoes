<?php namespace Joearcher\Tomatoes;


/**
* @author Joe Archer <joe.archer@gmail.com>
* @copyright Copyright (c) 2015
* @license    http://www.opensource.org/licenses/mit-license.html MIT License
*/


class Tomatoes {

	/**
	* API key from config
	*@var string
	**/

	protected $apiKey;
	
	/**
	* Base API url
	*@var string
	**/

	protected $baseUrl;

	/**
	*Instance of Guzzle client
	*@var \GuzzleHttp\Client
	**/

	protected $client;


	/**
	*set everything up
	*@return void
	**/
	public function __construct()
	{
		$this->apiKey = config('tomatoes.apikey');

		if($this->apiKey == ""){
			abort(401, 'You must provide a valid Rotten Tomatoes API key');
		}

		$this->baseUrl = 'http://api.rottentomatoes.com/api/public/v1.0/';
		$this->client = new \GuzzleHttp\Client();
	}

	/**
	 * 
	 * Searches on provided query for movie titles
	 *
	 * @param  string $q search terms
	 * @param  int $limit number of results per page
	 * @param  int $page page number for pages results
	 * @return  array json_encoded array of results
	 */

	public function search($term = NULL,$limit = NULL,$page = NULL)
	{
		//make sure we have a search term
		if($term == NULL || $term == ""){
			abort(400, 'You must provide a search term');
		}

		//set the limit and page strings
		if($limit !== NULL){
			$limit = "&page_limit=".$limit;
		}

		if($page !== NULL){
			$page = "&page=".$page;
		}
		
		//set the url
		$endpoint = 'movies.json';
		
		//set the serach term
		$q = "&q=".urlencode($term);
		
		//buld the request string
		$params = $q.$limit.$page;
		
		return $this->doRequest($endpoint,$params);
		
	}

	/**
	 * 
	 * Gets movie info by ID
	 *
	 * @param  int $id ID of movie to find
	 * @return  array json_encoded array of results
	 */

	public function movie($id = NULL)
	{
		if($id == NULL || $id == ""){
			abort(400, 'You must provide a movie ID');
		}

		$endpoint = 'movies/'.$id.'.json';

		return $this->doRequest($endpoint);
	}

	/**
	 * 
	 * Gets the cast of movie with provided ID
	 *
	 * @param  int $id ID of movie to cast for
	 * @return  array json_encoded array of results
	 */
	

	public function cast($id = NULL)
	{
		if($id == NULL || $id == ""){
			abort(400, 'You must provide a movie ID');
		}

		$endpoint = "movies/$id/cast.json";

		return $this->doRequest($endpoint);
	}

	/**
	 * 
	 * Gets reviews of movie with provided ID
	 *
	 * @param  int $id ID of movie to find reviews for
	 * @return  array json_encoded array of results
	 */

	public function reviews($id = NULL)
	{
		if($id == NULL || $id == ""){
			abort(400, 'You must provide a movie ID');
		}

		$endpoint = "movies/$id/reviews.json";

		return $this->doRequest($endpoint);
	}

	/**
	 * 
	 * Gets similar movies to movie with provided ID
	 *
	 * @param  int $id ID of movie to find similes of
	 * @return  array json_encoded array of results
	 */

	public function similar($id = NULL)
	{
		if($id == NULL || $id == ""){
			abort(400, 'You must provide a movie ID');
		}

		$endpoint = "movies/$id/similar.json";

		return $this->doRequest($endpoint);
	}


	/**
	*
	* Does the actual request
	*
	*@param string $endpoint API endpoint
	*@param string $params Request parameters
	*@return array api response
	**/


	private function doRequest($endpoint, $params = NULL)
	{

		//set the api key string;
		$key = "?apikey=".$this->apiKey;
		
		//build the request string
		$req = $this->baseUrl.$endpoint.$key.$params;

		//make the request
		try 
		{
			
			$res = $this->client->get($req);

		} 

		catch (Exception $e) 
		{
			
		}
		

		//get the response as an array
		$response = $res->json();

		//return the response
		return $response;
	}


}