> Project Made using PHP

> ### Please Note: 
* Project Online Hosted Link :
    > https://project-ms-adarsh.000webhostapp.com/


  
# To open website first make a Database as  
* project_mngmt

# Database contains 4 tables , namely :
* 1) user_details
  2) todo_list
  3) doing_list
  4) done_list

# Schema for each table is as follows: 

* >1)user_details : 
    # 	Name 	        Type 	        Collation 	        Attributes 	Null 	Default 	Comments 	Extra 	
    1 	id(Primary)     int(25) 			                            No 	    None 		            AUTO_INCREMENT 	

    2 	email 	        varchar(255) 	utf8mb4_general_ci 		        No 	    None 			

    3 	pass 	        varchar(255) 	utf8mb4_general_ci 		        No 	    None 				

    4 	names 	        varchar(255) 	utf8mb4_general_ci 		        No 	    None 
    

* >2)todo_list :
    # 	Name 	            Type 	        Collation 	Attributes 	Null 	Default 	Comments 	Extra 	
    1 	todo_id (Primary) 	int(25) 			                    No 	    None 		            AUTO_INCREMENT 	

    2 	todo_titles 	    varchar(255) 	utf8mb4_general_ci 		No 	    None 		

    3 	todo 	            varchar(255) 	utf8mb4_general_ci 		No 	    None 				

    4 	id 	                int(11) 			                    No 	    None 	


* >3)doing_list:
    # 	Name 	            Type 	        Collation 	Attributes 	Null 	Default 	Comments 	Extra 
    1 	doing_id (Primary) 	int(25) 			                    No 	    None 		            AUTO_INCREMENT 

    2 	doing_titles 	    varchar(255) 	utf8mb4_general_ci 		No 	    None 			

    3 	doing 	            varchar(255) 	utf8mb4_general_ci 		No 	    None 		

    4 	id 	int(25) 			                                    No 	    None 		


* >4)done_list:
    # 	Name 	                Type 	        Collation 	Attributes 	Null 	Default 	Comments 	Extra 	
    1 	done_id (Primary) 	    int(25) 			                    No 	None 		                AUTO_INCREMENT 	

    2 	done_titles 	        varchar(255) 	utf8mb4_general_ci 		No 	None 		

    3 	done 	                varchar(255) 	utf8mb4_general_ci 		No 	None 			

    4 	id 	                    int(11) 			                    No 	None 	