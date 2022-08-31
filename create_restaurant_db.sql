/********************************************************
* This script creates the database named restaurantdb 
*********************************************************/

DROP DATABASE IF EXISTS restaurant_db;
CREATE DATABASE restaurant_db;
USE restaurant_db;

-- create the tables for the database
CREATE TABLE restaurants (
	restaurant_id		INT				PRIMARY KEY 	AUTO_INCREMENT,
	restaurant_name 	VARCHAR(60) 	NOT NULL,
	address				VARCHAR(60)    	NOT NULL,
    city				VARCHAR(60)    	NOT NULL,
    state				VARCHAR(2)    	NOT NULL,
    zip_code			VARCHAR(10)		NOT NULL,
	food_type 			VARCHAR(60) 	NOT NULL,
	website_link 		TEXT 			DEFAULT NULL,
    image				varchar(2083)		DEFAULT NULL,
    logo				varchar(2083)		NOT NULL,
    average_rating		FLOAT				DEFAULT NULL
);

-- roll = 1: admin
-- roll = 2: user
CREATE TABLE users (
	user_id 			INT 			PRIMARY KEY 	AUTO_INCREMENT,
	first_name 			VARCHAR(60) 	NOT NULL,
	last_name 			VARCHAR(60) 	NOT NULL,
	email_address 		VARCHAR(255) 	NOT NULL,
	password 			VARCHAR(60) 	NOT NULL,
    role				INT				NOT NULL
);


CREATE TABLE reviews (
	review_id			INT 			PRIMARY KEY 	AUTO_INCREMENT,
    restaurant_id		INT				NOT NULL,
    user_id 			INT				NOT NULL,
	description 		TEXT 			NOT NULL,
    rating 				INT 			NOT NULL,
    CONSTRAINT review_fk_restaurants
		FOREIGN KEY (restaurant_id)
		REFERENCES restaurants (restaurant_id),
	CONSTRAINT review_fk_users
		FOREIGN KEY (user_id)
		REFERENCES users (user_id)
);

-- Insert Admin account
INSERT INTO users VALUES
(1, "David", "Harianto", "davidharianto@gmail.com", "password", 1);

-- Insert Restaurants
INSERT INTO restaurants VALUES
(1, "Chick-fil-A", "770 Texas Rd", "Old Bridge", "NJ", "08857", "Fast food", "https://cfaoldbridge.com/", 
"https://static.cfacdn.com/photos/restaurants/03979/large.jpg", 
"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSWe59rh2WLHAM1FK0eokb3ihPwgvebM6hGMw&usqp=CAU", null),
(2, "McDonald's", "78 U.S. 9", "Englishtown", "NJ", "07726", "Fast food", "https://www.mcdonalds.com/us/en-us/location/NJ/ENGLISHTOWN/78-RT-9/6751.html?cid=RF:YXT:GMB::Clicks", 
"https://cdn.usarestaurants.info/assets/uploads/b10034cb53f529e3b7be8b764a090c0d_-united-states-new-jersey-monmouth-county-englishtown-119680-mcdonaldshtm.jpg", 
"https://blog.logomyway.com/wp-content/uploads/2017/01/mcdonalds-logo-1.jpg", null),
(3, "Jinli Sichuan", "71 S Main St", "Marlboro", "NJ", "07746", "Chinese", "https://www.jinlisichuan.com/", 
"https://cdn.usarestaurants.info/assets/uploads/8df8dd9c85bffcceb747a5a758b1243d_-united-states-new-jersey-monmouth-county-marlboro-township-667453-jinli-sichuan-cuisinehtm.jpg",
"https://media-cdn.grubhub.com/image/upload/d_search:browse-images:default.jpg/w_1200,h_800,f_auto,fl_lossy,q_80,c_fit/dlmq363dkllmwfxfryys", null),
(4, "Moe's Southwest Grill", "82 U.S. 9", "Englishtown", "NJ", "07726", "Mexican", "https://locations.moes.com/nj/englishtown/82-us-highway-9?utm_source=google&utm_medium=organic&utm_campaign=locations_partner", 
"https://media-cdn.tripadvisor.com/media/photo-s/07/51/31/ab/moe-s-southwest-grill.jpg",
"https://pbs.twimg.com/profile_images/416214315/Moes-WAPE_400x400.jpg", null),
(5, "Olive Garden", "290 W Main St", "Freehold", "NJ", "07728", "Italian", "https://www.olivegarden.com/locations/nj/freehold/freehold-marketplace-plaza/1834?cmpid=br:og_ag:ie_ch:loc_ca:OGGMB_sn:gmb_gt:freehold-nj-1834_pl:locurl_rd:1679", 
"https://media.olivegarden.com/en_us/images/marketing/italian-family-restaurant-olive-garden-g6-rdv.jpg",
"https://media.olivegarden.com/images/site/logo_olivegarden.png" , null);
