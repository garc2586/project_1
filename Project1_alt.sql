-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2017 at 11:54 PM
-- Server version: 5.5.57-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `Project1_alt`
--

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE IF NOT EXISTS `genre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`id`, `name`) VALUES
(null, 'animation'),
(null, 'adventure'),
(null, 'sci-fi'),
(null, 'fantasy'),
(null, 'mystery'),
(null, 'action'),
(null, 'romance'),
(null, 'drama'),
(null, 'thriller'),
(null, 'comedy');

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE IF NOT EXISTS `movie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `price` double NOT NULL,
  `genre_id` int(11) NOT NULL,
  `studio_id` int(11) NOT NULL,
  `movie_desc` varchar(500) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `genre_id` (`genre_id`,`studio_id`),
  KEY `studio_id` (`studio_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`id`, `name`, `price`, `genre_id`, `studio_id`, `movie_desc`) VALUES
(null, 'Toy Story', 15, 1, 2, 'Toy Story is about the ''secret life of toys'' when people are not around. When Buzz Lightyear, a space-ranger, takes Woody''s place as Andy''s favorite toy, Woody doesn''t like the situation and gets into a fight with Buzz. ... A toy named Woody has it all.'),
(null, 'Shrek', 5, 2, 3, 'Shrek is a fictional ogre character created by American author William Steig. Shrek is the protagonist of the book of the same name and of eponymous films by DreamWorks Animation. The name "Shrek" is derived from the German word Schreck, meaning "fright" or "terror".'),
(null, 'The Lion King', 10, 1, 1, 'A young lion prince is born in Africa, thus making his uncle Scar the second in line to the throne. Scar plots with the hyenas to kill King Mufasa and Prince Simba, thus making himself King. The King is killed and Simba is led to believe by Scar that it was his fault, and so flees the kingdom in shame.'),
(null, 'Spirited Away', 10, 4, 4, 'The major themes of Spirited Away center on the protagonist Chihiro and her liminal journey through the realm of spirits. The archetypal entrance into another world demarcates Chihiro''s status as one somewhere between child and adult. Chihiro also stands outside societal boundaries in the supernatural setting.'),
(null, 'My Neighbor Totoro', 7, 2, 4, 'wo young girls, Satsuki and her younger sister Mei, move into a house in the country with their father to be closer to their hospitalized mother. Satsuki and Mei discover that the nearby forest is inhabited by magical creatures called Totoros (pronounced toe-toe-ro). They soon befriend these Totoros, and have several magical adventures.'),
(null, 'Princess Mononoke', 9, 6, 4, 'The ambitious Lady Eboshi and her loyal clan use their guns against the gods of the forest and a brave young woman, Princess Mononoke, who was raised by a wolf-god. Ashitaka sees the good in both sides and tries to stem the flood of blood. ... Ashitaka is infected with an incurable disease by a possessed boar/god.'),
(null, 'Howls Moving Castle', 13, 2, 4, 'Seeking to break the curse, Sophie leaves home and sets off through the country. She meets a scarecrow, whom she decides to call ''Turnip Head''. He leads her to Howl''s moving castle, where she meets Howl''s young apprentice, Markl, and the fire-demon Calcifer, who is the source of the castle''s energy and magic.'),
(null, 'Kikis Delivery Service', 7, 2, 4, 'Kiki''s Delivery Service is a 1989 fantasy anime produced by Studio Ghibli and written, produced, and directed by Hayao Miyazaki as an adaptation of the 1985 novel of the same name by Eiko Kadono.'),
(null, 'Castle in the Sky', 6, 4, 4, 'Castle in the Sky is a 1986 Japanese animated adventure film written and directed by Hayao Miyazaki that marked the cinematic feature debut of Studio Ghibli.'),
(null, 'Ponyo', 13, 4, 4, 'The son of a sailor, 5-year old Sosuke lives a quiet life on an oceanside cliff with his mother Lisa. One fateful day, he finds a beautiful goldfish trapped in a bottle on the beach and upon rescuing her, names her Ponyo.'),
(null, 'Nausicaa of the Valley of the Wind', 7, 4, 4, 'Far in the future, after an apocalyptic conflict has devastated much of the world''s ecosystem, the few surviving humans live in scattered semi-hospitable environments within what has become a "toxic jungle."'),
(null, 'Porco Rosso', 10, 4, 4, 'Porco Rosso is a 1992 Japanese anime comedy-adventure film written and directed by Hayao Miyazaki. ... Once called Marco Pagot (Marco Rossolini in the American version), he is now known to the world as "Porco Rosso", Italian for "Red Pig".'),
(null, 'The Castle of Cagliostro', 5, 1, 4, 'When master thief Lupin III (Yasuo Yamada) discovers that the money he robbed from a casino is counterfeit, he goes to Cagliostro, rumored to be the source of the forgery.'),
(null, 'The Secret World of Arriety', 14, 1, 4, 'Arrietty (Bridgit Mendler), a tiny teenager, lives with her parents (Amy Poehler, Will Arnett) in the recesses of a suburban home, unbeknown to the homeowner and housekeeper.'),
(null, 'Aladdin', 6, 4, 1, 'When street rat Aladdin frees a genie from a lamp, he finds his wishes granted. However, he soon finds that the evil has other plans for the lamp -- and for Princess Jasmine. But can Aladdin save Princess Jasmine and his love for her after she sees that he isn''t quite what he appears to be?'),
(null, 'Mulan', 7, 4, 1, 'Fearful that her ailing father will be drafted into the Chinese military, Mulan (Ming-Na Wen) takes his spot -- though, as a girl living under a patriarchal regime, she is technically unqualified to serve. She cleverly impersonates a man and goes off to train with fellow recruits.'),
(null, 'The Little Mermaid', 5, 4, 1, 'In Disney''s beguiling animated romp, rebellious 16-year-old mermaid Ariel (Jodi Benson) is fascinated with life on land. On one of her visits to the surface, which are forbidden by her controlling father, King Triton, she falls for a human prince.'),
(null, 'Beauty and the Beast', 7, 7, 1, 'An arrogant young prince (Robby Benson) and his castle''s servants fall under the spell of a wicked enchantress, who turns him into the hideous Beast until he learns to love and be loved in return. The spirited, headstrong village girl Belle (Paige O''Hara) enters the Beast''s castle after he imprisons her father Maurice (Rex Everhart).'),
(null, 'Cinderella', 5, 7, 1, 'With a wicked stepmother (Eleanor Audley) and two jealous stepsisters (Rhoda Williams, Lucille Bliss) who keep her enslaved and in rags, Cinderella (Ilene Woods) stands no chance of attending the royal ball. '),
(null, 'Snow White', 4, 7, 1, 'The Grimm fairy tale gets a Technicolor treatment in Disney''s first animated feature. Jealous of Snow White''s beauty, the wicked queen orders the murder of her innocent stepdaughter, but later discovers that Snow White is still alive and hiding in a cottage with seven friendly little miners.'),
(null, 'Pinocchio', 5, 4, 1, 'When the woodworker Geppetto (Christian Rub) sees a falling star, he wishes that the puppet he just finished, Pinocchio (Dickie Jones), could become a real boy. In the night, the Blue Fairy (Evelyn Venable) grants Geppetto''s wish and asks Jiminy Cricket (Cliff Edwards) to serve as the wooden boy''s conscience.'),
(null, 'Sleeping Beauty', 6, 8, 1, 'Filled with jealousy, the evil witch Maleficent (Eleanor Audley) curses Princess Aurora (Mary Costa) to die on her 16th birthday. Thanks to Aurora''s guardian fairies (Verna Felton, Barbara Jo Allen, Barbara Luddy), she only falls into a deep sleep that can be ended with a kiss from her betrothed, Prince Phillip (Bill Shirley).'),
(null, 'Pocahontas', 9, 7, 1, 'This is the Disney animated tale of the romance between a young American Indian woman named Pocahontas (Irene Bedard) and Capt. John Smith (Mel Gibson), who journeyed to the New World with other settlers to begin fresh lives.'),
(null, 'Alice in Wonderland', 8, 2, 1, 'Lewis Carroll''s beloved fantasy tale is brought to life in this Disney animated classic. When Alice (Kathryn Beaumont), a restless young British girl, falls down a rabbit hole, she enters a magical world. There she encounters an odd assortment of characters, including the grinning Cheshire Cat (Sterling Holloway) and the goofy Mad Hatter (Ed Wynn). '),
(null, 'Peter Pan', 8, 2, 1, 'In this Disney animated film, Wendy (Kathryn Beaumont) and her two brothers are amazed when a magical boy named Peter Pan (Bobby Driscoll) flies into their bedroom, supposedly in pursuit of his rebellious shadow. He and his fairy friend, Tinkerbell, come from a far-off place called Neverland, where children stay perpetually young.'),
(null, 'The Jungle Book', 10, 2, 1, 'In this classic Walt Disney animation based on Rudyard Kipling''s book, Mowgli, an abandoned child raised by wolves, has his peaceful existence threatened by the return of the man-eating tiger Shere Khan (George Sanders). Facing certain death, Mowgli must overcome his reluctance to leave his wolf family and return to the "man village."'),
(null, 'Lilo and Stitch', 11, 3, 1, 'A tale of a young girl''s close encounter with the galaxy''s most wanted extraterrestrial. Lilo is a lonely Hawaiian girl who adopts a small ugly "dog," whom she names Stitch. Stitch would be the perfect pet if he weren''t in reality a genetic experiment who has escaped from an alien planet and crash-landed on Earth.'),
(null, 'The Nightmare Before Christmas', 9, 4, 1, 'The film follows the misadventures of Jack Skellington, Halloweentown''s beloved pumpkin king, who has become bored with the same annual routine of frightening people in the "real world." When Jack accidentally stumbles on Christmastown, all bright colors and warm spirits, he gets a new lease on life -- he plots to bring Christmas under his control by kidnapping Santa Claus and taking over the role.'),
(null, 'Finding Nemo', 12, 10, 2, 'Marlin (Albert Brooks), a clown fish, is overly cautious with his son, Nemo (Alexander Gould), who has a foreshortened fin. When Nemo swims too close to the surface to prove himself, he is caught by a diver, and horrified Marlin must set out to find him.'),
(null, 'Monsters Inc.', 11, 2, 2, 'Monsters Incorporated is the largest scare factory in the monster world, and James P. Sullivan (John Goodman) is one of its top scarers. Sullivan is a huge, intimidating monster with blue fur, large purple spots and horns. His scare assistant, best friend and roommate is Mike Wazowski (Billy Crystal), a green, opinionated, feisty little one-eyed monster.'),
(null, 'The Dark Knight', 10, 9, 5, 'With the help of allies Lt. Jim Gordon (Gary Oldman) and DA Harvey Dent (Aaron Eckhart), Batman (Christian Bale) has been able to keep a tight lid on crime in Gotham City. But when a vile young criminal calling himself the Joker (Heath Ledger) suddenly throws the town into chaos, the caped Crusader begins to tread a fine line between heroism and vigilantism.'),
(null, 'The Incredibles', 13, 6, 2, 'n this lauded Pixar animated film, married superheroes Mr. Incredible (Craig T. Nelson) and Elastigirl (Holly Hunter) are forced to assume mundane lives as Bob and Helen Parr after all super-powered activities have been banned by the government.'),
(null, 'Cars', 12, 2, 2, 'While traveling to California to race against The King (Richard Petty) and Chick Hicks (Michael Keaton) for the Piston Cup Championship, Lightning McQueen (Owen Wilson) becomes lost after falling out of his trailer in a run down town called Radiator Springs.'),
(null, 'WALL-E', 14, 3, 2, 'WALL-E, short for Waste Allocation Load Lifter Earth-class, is the last robot left on Earth. He spends his days tidying up the planet, one piece of garbage at a time. But during 700 years, WALL-E has developed a personality, and he''s more than a little lonely.'),
(null, 'Ratatouille', 15, 4, 2, 'Remy (Patton Oswalt), a resident of Paris, appreciates good food and has quite a sophisticated palate. He would love to become a chef so he can create and enjoy culinary masterpieces to his heart''s delight. The only problem is, Remy is a rat.'),
(null, 'Up', 15, 10, 2, 'Carl Fredricksen (Ed Asner), a 78-year-old balloon salesman, is about to fulfill a lifelong dream. Tying thousands of balloons to his house, he flies away to the South American wilderness. But curmudgeonly Carl''s worst nightmare comes true when he discovers a little boy named Russell is a stowaway aboard the balloon-powered house.'),
(null, 'Inside Out', 15, 10, 2, 'Riley (Kaitlyn Dias) is a happy, hockey-loving 11-year-old Midwestern girl, but her world turns upside-down when she and her parents move to San Francisco. Riley''s emotions -- led by Joy (Amy Poehler) -- try to guide her through this difficult, life-changing event. However, the stress of the move brings Sadness (Phyllis Smith) to the forefront.'),
(null, 'A Bugs Life', 8, 2, 2, 'Flik (Dave Foley) is an inventive ant who''s always messing things up for his colony. His latest mishap was destroying the food stores that were supposed to be used to pay off grasshopper Hopper (Kevin Spacey). Now the strong-arming insect is demanding that the ants gather double the food -- or face annihilation.'),
(null, 'Wonder Woman', 15, 6, 5, 'Before she was Wonder Woman (Gal Gadot), she was Diana, princess of the Amazons, trained to be an unconquerable warrior. Raised on a sheltered island paradise, Diana meets an American pilot (Chris Pine) who tells her about the massive conflict thats raging in the outside world'),
(null, 'Lego Movie', 10, 2, 5, 'Emmet (Chris Pratt), an ordinary LEGO figurine who always follows the rules, is mistakenly identified as the Special -- an extraordinary being and the key to saving the world. He finds himself drafted into a fellowship of strangers who are on a mission to stop an evil tyrants (Will Ferrell) plans to conquer the world.'),
(null, 'Inception', 10, 9, 5, 'Dom Cobb (Leonardo DiCaprio) is a thief with the rare ability to enter peoples dreams and steal their secrets from their subconscious. His skill has made him a hot commodity in the world of corporate espionage but has also cost him everything he loves.');

-- --------------------------------------------------------

--
-- Table structure for table `studio`
--

CREATE TABLE IF NOT EXISTS `studio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `studio`
--

INSERT INTO `studio` (`id`, `name`) VALUES
(null, 'Disney'),
(null, 'Pixar'),
(null, 'Dreamworks'),
(null, 'Studio Ghibli'),
(null, 'Warner Brothers');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `movie`
--
ALTER TABLE `movie`
  ADD CONSTRAINT `movie_ibfk1` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`),
  ADD CONSTRAINT `movie_ibfk2` FOREIGN KEY (`studio_id`) REFERENCES `studio` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
