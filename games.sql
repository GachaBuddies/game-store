-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2024 at 03:36 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `games`
--
CREATE DATABASE IF NOT EXISTS `games` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `games`;

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `genreID` int(11) NOT NULL,
  `genreName` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`genreID`, `genreName`) VALUES
(1, 'Action'),
(2, 'Adventure'),
(3, 'RPG'),
(4, 'Simulation'),
(5, 'Strategy'),
(6, 'Sports'),
(7, 'Racing'),
(8, 'Puzzle'),
(9, 'Fighting'),
(10, 'Horror'),
(11, 'Sandbox'),
(12, 'Stealth'),
(13, 'Survival'),
(14, 'MOBA'),
(15, 'Battle Royale'),
(16, 'First-Person Shooter'),
(17, 'Third-Person Shooter'),
(18, 'MMORPG'),
(19, 'Platformer'),
(20, 'Music/Rhythm'),
(21, 'Puzzle-Platformer'),
(22, 'Educational'),
(23, 'Casual'),
(24, 'Indie'),
(25, 'Open World'),
(26, 'Historical'),
(27, 'Sci-Fi'),
(28, 'Fantasy'),
(29, 'Real-Time Strategy'),
(30, 'Turn-Based Strategy'),
(31, 'Dating Sim'),
(32, 'Visual Novel'),
(33, 'Mystery'),
(34, 'Dress-Up');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `picture` text NOT NULL,
  `productName` varchar(225) NOT NULL,
  `price` int(11) NOT NULL,
  `description` text NOT NULL,
  `genreID` int(11) NOT NULL,
  `views` int(11) NOT NULL,
  `rates` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `picture`, `productName`, `price`, `description`, `genreID`, `views`, `rates`) VALUES
(1, 'pic1.png', 'Life Is Strange', 20, 'Life Is Strange is an episodic graphic adventure video game that follows the story of Max Caulfield, a photography student who discovers she has the ability to rewind time. As she navigates through her high school life in Arcadia Bay, Max uncovers dark secrets and makes choices that impact the narrative.', 2, 1500000, 9.5),
(2, 'pic2.png', 'Life Is Strange: Before The Storm', 25, 'Before The Storm is a prequel to Life Is Strange, exploring the backstory of Chloe Price, a rebellious teenager. Set three years before the events of the first game, players witness Chloe\'s relationship with Rachel Amber and the challenges she faces in Arcadia Bay.', 2, 800000, 8.5),
(3, 'pic3.png', 'Life Is Strange 2', 40, 'Life Is Strange 2 follows the journey of two brothers, Sean and Daniel Diaz, who are on the run after a tragic incident. The game explores themes of brotherhood, racism, and the impact of supernatural abilities as the brothers make difficult choices on their way to Mexico.', 2, 600000, 8.7),
(4, 'pic4.png', 'Life Is Strange: True Colors', 50, 'True Colors introduces players to Alex Chen, a young woman with the supernatural ability to absorb and manipulate emotions. Returning to her hometown of Haven Springs, Alex unravels a mystery surrounding her brother\'s death, using her powers to uncover the truth.', 2, 400000, 9.2),
(5, 'pic5.png', 'Life Is Strange: Remastered', 30, 'The Remastered edition brings the original Life Is Strange with enhanced visuals and improved animations. Players experience the emotional and narrative depth of the first game with updated graphics and refined character models.', 2, 300000, 8),
(6, 'pic6.png', 'Danganronpa: Trigger Happy Havoc', 30, 'Trigger Happy Havoc is the first game in the Danganronpa series, where students find themselves trapped in a high school and forced to participate in a deadly game. Players investigate murders, solve puzzles, and engage in class trials to uncover the truth.', 33, 2000000, 9.1),
(7, 'pic7.png', 'Danganronpa 2: Goodbye Despair', 30, 'Goodbye Despair is the sequel to Trigger Happy Havoc, featuring a new cast of characters on a tropical island. The game follows a similar structure, with students facing deadly trials and uncovering the mysteries surrounding their predicament.', 33, 1800000, 9.3),
(8, 'pic8.png', 'Danganronpa V3: Killing Harmony', 40, 'Killing Harmony is the third main installment in the Danganronpa series, set in a new environment with a fresh cast of characters. The game introduces a revamped class trial system and challenges players to unravel the truth behind the killing game.', 33, 1500000, 8.8),
(9, 'pic9.png', 'Master Detective Archives: RAIN CODE', 25, 'RAIN CODE is a detective game where players take on the role of a master detective solving complex cases. The game combines investigative gameplay with a compelling narrative as players uncover the truth behind each mystery.', 33, 500000, 8.5),
(10, 'pic10.png', 'Danganronpa Another Episode: Ultra Despair Girls', 30, 'Ultra Despair Girls is a spin-off of the Danganronpa series, combining elements of third-person shooter and visual novel. Players control Komaru Naegi, armed with a hacking gun and Toko Fukawa, armed with a taser which she can change her personality to Genocide Jack, a serial killer armed with hand-made scissors, as they face off against Monokuma robots in a city overrun by despair.', 17, 700000, 8.6),
(11, 'pic11.png', 'Layton\'s Mystery Journey: Katrielle and the Millionaires\' Conspiracy', 35, 'Layton\'s Mystery Journey: Katrielle and the Millionaires\' Conspiracy is a puzzle adventure game developed by Level-5. Join Katrielle Layton, daughter of the famous Professor Layton, as she solves various mysteries in London.', 8, 400000, 8.2),
(12, 'pic12.png', 'Phoenix Wright: Ace Attorney', 20, 'Ace Attorney is a visual novel adventure game where players assume the role of defense attorney Phoenix Wright. The game combines investigation and courtroom drama as players defend their clients and uncover the truth behind each case.', 8, 300000, 8.5),
(13, 'pic13.png', 'Phoenix Wright: Ace Attorney – Justice for All', 20, 'Justice for All is the second game in the Ace Attorney series, continuing Phoenix Wright\'s legal adventures. Players tackle new cases, cross-examine witnesses, and confront challenging moral dilemmas in the courtroom.', 8, 250000, 8.3),
(14, 'pic14.png', 'Phoenix Wright: Ace Attorney – Trials and Tribulations', 20, 'Trials and Tribulations concludes the original Ace Attorney trilogy, offering more courtroom drama, engaging characters, and intricate cases. Players delve into Phoenix Wright\'s past and face emotional trials.', 8, 200000, 8.8),
(15, 'pic15.png', 'Apollo Justice: Ace Attorney', 25, 'Apollo Justice introduces a new protagonist, Apollo Justice, as players step into the shoes of a young defense attorney. The game explores the legal world with fresh perspectives and a new set of cases.', 8, 180000, 8.2),
(16, 'pic16.png', 'Ace Attorney Investigations: Miles Edgeworth', 25, 'Investigations shifts the focus to Miles Edgeworth, a prosecutor, as players investigate crime scenes and solve mysteries outside the courtroom. The game combines logic puzzles and deductive reasoning.', 8, 150000, 8.5),
(17, 'pic17.png', 'Ace Attorney Investigations 2: Prosecutor\'s Path', 30, 'Prosecutor\'s Path is the sequel to Investigations, featuring Miles Edgeworth as he unravels complex cases. Players engage in investigations, interrogations, and courtroom battles to bring justice to the legal system.', 8, 120000, 8.8),
(18, 'pic18.png', 'Phoenix Wright: Ace Attorney – Dual Destinies', 30, '\"Dual Destinies\" is set one year after the events of \"Apollo Justice: Ace Attorney\" and follows Phoenix Wright as he returns to the courtroom after being disbarred. The legal world faces a crisis, known as the \"Dark Age of the Law,\" where distrust in the legal system is prevalent. Phoenix, along with Apollo Justice and newcomer Athena Cykes, works to restore trust in the legal system by tackling a series of challenging cases.\r\n\r\nThe game explores themes of justice, corruption, and the pursuit of truth, and it introduces the Mood Matrix, a new gameplay mechanic that allows players to analyze the emotions of witnesses during testimony.', 8, 100000, 8.9),
(19, 'pic19.png', 'Phoenix Wright: Ace Attorney – Spirit of Justice', 30, '\"Spirit of Justice\" is set in the foreign country of Khura\'in, where the legal system is based on the Divination Séance, a mystical ritual that shows the last moments of a victim\'s life. Phoenix Wright, along with Apollo Justice and Athena Cykes, finds himself in Khura\'in, where he must navigate the intricacies of the legal system and defend clients in a series of challenging cases.\r\n\r\nThe narrative explores themes of justice, religious beliefs, and the clash between different legal systems, offering a unique and culturally diverse setting.', 8, 80000, 9),
(20, 'pic20.png', 'Doki Doki Literature Club!', 0, 'The game starts with the player assuming the role of a high school student who joins the school\'s literature club, which is populated by four girls: Sayori, Natsuki, Yuri, and Monika. The player engages in daily activities, including writing poems, sharing them with club members, and participating in conversations.\r\n\r\nHowever, the seemingly ordinary premise takes a dark turn as the narrative explores themes of mental health, self-awareness, and the consequences of manipulation. The game challenges typical visual novel conventions and explores the impact of player choices on the story.', 32, 200000, 9.2),
(21, 'pic21.png', 'Your Boyfriend', 6, 'Your Boyfriend is a horror visual novel that explores dark themes. Navigate a disturbing narrative and make choices that impact the story and its multiple endings.', 32, 100000, 8.5),
(22, 'pic22.png', 'Among Us', 0, '\"Among Us\" is set on a space-themed setting where players take on the roles of Crewmates aboard a spaceship or Impostors trying to sabotage the mission. The game is designed for 4 to 15 players, with the Crewmates working together to complete tasks around the ship, while the Impostors attempt to eliminate them and take control.\r\n\r\nThe core gameplay involves discussion and deduction during meetings, where players must identify the Impostors based on their actions and observations. The game is known for its social deduction elements and the need for effective communication.', 18, 500000, 9.1),
(23, 'pic23.png', 'Five Nights At Freddy\'s', 8, 'The premise of \"Five Nights at Freddy\'s\" revolves around the player taking on the role of a night security guard at Freddy Fazbear\'s Pizza, a fictional family restaurant. The restaurant features animatronic characters that entertain during the day, but at night, they become unpredictable and potentially dangerous.\r\n\r\nThe player must survive five nights (and additional nights in subsequent games) by monitoring security cameras and managing limited resources, such as electricity for doors and lights. The animatronics, including Freddy Fazbear and his friends, become more active and aggressive as the nights progress.', 24, 1000000, 9.3),
(24, 'pic24.png', 'Five Nights At Freddy\'s 2', 8, '\"Five Nights at Freddy\'s 2\" is set in Freddy Fazbear\'s Pizza, a haunted and seemingly abandoned restaurant. Unlike the first game, which took place in a security office, this installment is set in a newer location with more animatronic characters. The player takes on the role of a security guard who must survive five nights while dealing with malfunctioning animatronics.\r\n\r\nThe game delves into the backstory of the restaurant and the reasons behind the animatronics\' aggressive behavior. It introduces new characters, including Toy Freddy, Toy Bonnie, Toy Chica, Mangle, and others, along with the returning characters from the first game.', 24, 800000, 9.2),
(25, 'pic25.png', 'Five Nights At Freddy\'s 3', 8, '\"Five Nights at Freddy\'s 3\" takes place 30 years after the closure of Freddy Fazbear\'s Pizza. The player assumes the role of a security guard working at Fazbear\'s Fright, a horror attraction based on the legends of the previous restaurants. The attraction salvages old animatronics, including the withered and damaged versions of the original characters.\r\n\r\nThe game introduces a new antagonist, Springtrap, which is a hybrid animatronic and the main source of terror during the player\'s night shift. The narrative explores the mystery surrounding the haunted animatronics and the dark history of Freddy F azbear\'s Pizza.', 24, 600000, 8.9),
(26, 'pic26.jpg', 'Five Nights At Freddy\'s 4', 8, '\"Five Nights at Freddy\'s 4\" deviates from the setting of a haunted pizzeria and takes place in a child\'s bedroom. The player assumes the role of a child who must survive five nights while dealing with animatronic nightmares that come to life. The game explores the fears and phobias of a child and delves into the backstory of the animatronics.\r\n\r\nThe narrative revolves around the child\'s experiences and the creepy animatronics known as Nightmare Freddy, Nightmare Bonnie, Nightmare Chica, and Nightmare Foxy.', 24, 500000, 8.8),
(27, 'pic27.jpg', 'Five Nights At Freddy\'s: Sister Location', 8, 'The gameplay in \"Sister Location\" features more dynamic and varied scenarios compared to previous entries. Players move through different areas within Circus Baby\'s Pizza World, each presenting unique challenges and animatronics. The game introduces the concept of \"custom night\" challenges, allowing players to adjust difficulty settings for a personalized experience.\r\n\r\nThe player must navigate between rooms, perform maintenance tasks, and avoid detection by animatronics. The narrative unfolds through voiceovers and interactions with characters, adding a deeper layer to the horror experience.', 24, 400000, 8.7),
(28, 'pic28.png', 'Five Nights At Freddy\'s: Security Breach', 30, '\"Five Nights at Freddy\'s: Security Breach\" is the eighth installment in the Five Nights at Freddy\'s series. The game is set in a large entertainment complex called Freddy Fazbear\'s Mega Pizza Plex. Unlike the previous games that focused on a night security guard\'s perspective, \"Security Breach\" was expected to have a more dynamic environment and gameplay style.\r\n\r\nThe game introduces new animatronic characters, including Glamrock Freddy, Glamrock Chica, Montgomery Gator, and Roxanne Wolf. The narrative revolves around the player character navigating the Mega Pizza Plex and trying to survive the night while facing the animatronics.', 24, 300000, 8.6),
(29, 'pic29.png', 'Honkai Impact 3rd', 0, '\"Honkai Impact 3rd\" is set in a world that has been overrun by a mysterious force known as the Honkai. Players take on the role of the captain of an organization called \"Schicksal\" and command a team of powerful warriors known as Valkyries. The Valkyries possess unique abilities and wield powerful weapons to combat the Honkai and various other threats.\r\n\r\nThe game features an expansive and immersive storyline that unfolds through different chapters, each introducing new characters, enemies, and challenges. The narrative explores themes of sacrifice, friendship, and the battle against cosmic forces.', 1, 1000000, 9),
(30, 'pic30.png', 'Genshin Impact', 0, '\"Genshin Impact\" is set in the fantasy world of Teyvat, a land filled with magical elemental powers. Players take on the role of the Traveler, a character who embarks on a journey to search for their lost sibling. Throughout the adventure, players explore the vast open-world regions of Teyvat, encountering various characters, uncovering mysteries, and battling powerful foes.\r\n\r\nThe game features seven distinct regions, each inspired by different real-world cultures and elements associated with different elemental powers. Players can control characters with unique elemental abilities, and the game places a strong emphasis on exploration, puzzle-solving, and combat.', 25, 2000000, 9.2),
(31, 'pic31.png', 'Honkai: Star Rail', 0, 'In Honkai: Star Rail, players step into the shoes of the Trailblazer, a fearless warrior navigating a futuristic world threatened by the enigmatic Honkai. As the Trailblazer, embark on an epic space odyssey, encountering new allies and confronting powerful enemies. The game combines RPG elements with strategic combat, offering a gripping narrative and stunning visuals as players strive to protect the universe from the impending chaos', 30, 500000, 8.9),
(32, 'pic32.png', 'Reverse: 1999', 0, 'Reverse: 1999 is a turn-based tactical role-playing video game developed by Bluepoch. The game begins in London, England in 1999 on New Year\'s Eve at 23:59. Out of the gap between the two centuries, a \"Storm\" poured upwards to the sky. The next second, all the parties, neon signs, and late night buses faded away. The world returned to a strange old era. This young girl, the \"Timekeeper,\" the only one immune to the Storm, has witnessed the beginnings and ends of countless eras. During her time travel, she makes friends with arcanists from different times and countries and then guides them to escape the \"Storm.\"', 30, 200000, 8.6),
(33, 'pic33.png', 'Garry\'s Mod', 20, 'Garry\'s Mod, often abbreviated as Gmod, is a sandbox game that provides players with a wide range of tools and resources to create and manipulate game content. It originally created by Garry Newman and it doesn\'t have a specific narrative or objectives, allowing players the freedom to use their creativity to build and experiment within the game world.\r\n\r\nThe game uses the Source engine, the same engine that powers games like \"Half-Life 2\" and \"Counter-Strike: Source,\" providing players with access to assets from these games to use in their creations.', 11, 1500000, 9.1),
(34, 'pic34.png', 'Minecraft', 30, '\"Minecraft\" doesn\'t have a traditional narrative. Instead, it provides players with a vast, procedurally generated world made up of various biomes, landscapes, and resources. The primary objective is to survive, explore, and create. Players can gather resources, craft tools, build structures, and interact with the dynamic environment.\r\n\r\nThe game features two main modes: Survival, where players must manage resources and fend off hostile creatures, and Creative, where players have unlimited resources and can focus on building and exploration.', 11, 10000000, 9.3),
(35, 'pic35.png', 'Love Nikki', 0, 'The gameplay of \"Love Nikki\" primarily revolves around dressing up the main character, Nikki, and participating in styling battles. Players collect a vast array of clothing items, accessories, and makeup to create unique outfits. Styling battles involve competing against other in-game characters in fashion contests, where the player\'s creativity and outfit choices determine the outcome.\r\n\r\nThe game also features events, challenges, and a variety of quests to keep players engaged. The wardrobe in \"Love Nikki\" is extensive, featuring thousands of clothing items inspired by different styles, themes, and cultures.', 34, 500000, 8.8),
(36, 'pic36.png', 'Shining Nikki', 0, 'Shining Nikki, the highly anticipated sequel to Love Nikki, elevates the dress-up gaming experience to new heights. Set in a beautifully rendered 3D world, players immerse themselves in the glamour of fashion and design. Shining Nikki introduces innovative gameplay mechanics, including real-time dressing, dynamic poses, and a stunning wardrobe with a myriad of customization options. The game continues the captivating narrative of Miraland, unveiling new stories, characters, and challenges. With breathtaking visuals and a focus on creativity, Shining Nikki offers an unparalleled fashion journey for players seeking elegance and style in a mobile gaming experience.', 34, 300000, 9),
(37, 'pic37.png', 'RuPaul\'s Drag Race Superstar', 0, '\"RuPaul\'s Drag Race Superstar\" is a simulation and fashion mobile game inspired by the iconic reality competition show. Developed in collaboration with RuPaul, the game invites players into the dazzling world of drag, where they can become the ultimate drag superstar. With a focus on creativity, fashion, and showmanship, players embark on a journey to create their drag personas, design stunning looks, and participate in virtual drag competitions. The game captures the essence of the Drag Race experience, allowing players to showcase their style, charisma, uniqueness, nerve, and talent. \"RuPaul\'s Drag Race Superstar\" celebrates the art of drag and offers an interactive and entertaining experience for fans and newcomers alike, bringing the excitement of the runway to the palm of your hand.', 34, 200000, 8.9),
(38, 'pic38.png', 'Friday Night Funkin\'', 0, '\"Friday Night Funkin\'\" is a popular indie rhythm game that has gained widespread acclaim for its catchy music, unique art style, and engaging gameplay. Developed by Cameron Taylor, the game follows the story of Boyfriend, who is on a mission to impress Girlfriend by facing off against various characters in rhythmic music battles. Players must hit the correct keys in time with the beat to progress through the levels and win the affection of Girlfriend. With its infectious tunes, charming characters, and a vibrant community creating custom content, \"Friday Night Funkin\'\" has become a cultural phenomenon in the indie gaming scene. The game offers a blend of retro aesthetics, humor, and challenging rhythm mechanics, making it a favorite among fans of music games and indie titles alike. Whether you\'re a rhythm game enthusiast or simply looking for a fun and funky experience, \"Friday Night Funkin\' \" delivers an entertaining and memorable gaming journey.', 20, 1000000, 9.1),
(39, 'pic39.png', 'South Park: The Stick of Truth', 30, ' Embark on a hilarious and epic quest with the residents of South Park. In this role-playing game, you play as the \"New Kid\" who has just moved to the town. Join your favorite characters from the TV show, including Stan, Kyle, Cartman, and Kenny, as you become involved in a fantastical adventure involving wizards, elves, and, of course, the Stick of Truth. The game captures the irreverent and satirical humor of the TV series, providing an interactive experience in the familiar and beloved South Park universe.', 30, 500000, 8.9),
(40, 'pic40.png', 'South Park: The Fractured but Whole', 50, 'The superhero craze hits South Park, and it\'s time for the kids to play superheroes. In this sequel to \"The Stick of Truth,\" you once again take on the role of the \"New Kid\" and join the superhero alter-egos of the South Park characters. Led by Cartman as \"The Coon,\" the kids engage in a crime-fighting adventure that parodies the superhero genre. With a new combat system and expanded exploration, \"The Fractured but Whole\" offers an even more immersive and outrageous experience in the South Park universe. Expect laughs, surprises, and plenty of social commentary in this comedic RPG adventure.', 30, 400000, 9.2),
(41, 'pic41.jpg', 'Omori', 10, 'Omori is an indie RPG that combines traditional turn-based combat with psychological horror elements. The game follows the story of a character named Sunny, who retreats into a dream world, created by his own mind, to escape from the challenges and trauma of reality. In this dream world, Sunny takes on the persona of \"Omori\" and embarks on a journey accompanied by a cast of unique characters.\n\nThe game explores themes of friendship, mental health, and self-discovery. The narrative delves into both the dream world and the harsh realities of Sunny\'s life, creating an emotionally charged and immersive experience for players.', 3, 200000, 9.1),
(42, 'pic42.jpg', 'Undertale', 10, '\"Undertale\" takes place in a world where humans and monsters coexist. The player controls a human child who falls into the Underground, a realm inhabited by monsters who were banished there after a war with humans. The objective is to navigate through the Underground and find a way back to the surface.\r\n\r\nThe game is known for its non-traditional narrative choices, where the player\'s decisions, including choices in combat and interactions with characters, have a significant impact on the story and outcome. Players can choose to befriend or fight monsters, and the consequences of these choices shape the narrative.', 24, 1500000, 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`genreID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `genreID` (`genreID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `genreID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`genreID`) REFERENCES `genre` (`genreID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
