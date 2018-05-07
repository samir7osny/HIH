INSERT INTO `college` (`id`, `name`, `university_id`) VALUES
(1, 'Faculty Of Engineering', 1),
(2, 'Faculty of Medicine', 1),
(3, 'Faculty of Computers and Information System', 1),
(4, 'Faculty of Pharmacology', 1),
(5, 'Faculty of Agriculture', 1),
(6, 'Faculty of Science', 1),
(7, 'Faculty of Agriculture', 2),
(8, 'Faculty of Arts', 2),
(9, 'Faculty of Commerce', 2),
(10, 'Faculty of Computer and Information Sciences', 2);

INSERT INTO `committee` (`id`, `name`, `description`, `head_id`, `shortcut_id`) VALUES
(17, 'HR Committee', 'The team who is responsible for motivate and review the other teams', 6, 1),
(18, 'PR Committee', 'The team who is responsible for presenting HIH for the audience', NULL, 2),
(19, 'FR Committee', 'The team who is responsible for dealing with sponsors<br>', NULL, 3),
(20, 'Marketing Committee', 'The team who is responsible for the online pages for HIH&nbsp;', NULL, 4);

INSERT INTO `committees_codes` (`id`, `shortcut`) VALUES
(1, 'HR'),
(2, 'PR'),
(3, 'FR'),
(4, 'MK');

INSERT INTO `deleting_request` (`id`, `content`, `deleted_user_name`, `sender`, `member_to_delete_id`, `answer`, `answered`, `seen`, `seen_at`, `created_at`, `updated_at`) VALUES
(1, 'fndv fkdnv dfnv dfv', 'fvfv fvfv', 2, 4, 0, 1, 1, '2018-05-01 12:06:39', '2018-04-30 20:21:50', '2018-05-01 12:08:02'),
(2, 'jgn fgnbgf,bm fg,bfg bgf', 'fdmvk mkfmdvk', 2, 13, 1, 1, 1, '2018-05-01 11:38:59', '2018-05-01 08:12:36', '2018-05-01 11:40:33'),
(3, 'He is annoying me', NULL, 5, 2, NULL, 0, 0, NULL, '2018-05-06 09:00:25', '2018-05-06 09:00:25'),
(4, 'He is annoying me', NULL, 5, 2, NULL, 0, 0, NULL, '2018-05-06 09:00:38', '2018-05-06 09:00:38');

INSERT INTO `enrollment_in_events` (`event_id`, `guest_id`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, NULL),
(1, 2, NULL, NULL),
(11, 2, NULL, NULL);

INSERT INTO `enrollment_in_workshops` (`workshop_id`, `guest_id`, `created_at`, `updated_at`) VALUES
(4, 2, NULL, NULL);

INSERT INTO `event` (`id`, `name`, `description`, `place`, `place_cost`, `from`, `to`, `date`, `no_of_forms`, `cover_id`) VALUES
(11, 'إزرع خيرا 5.0', 'Helping poor with some food', 'الصف', 0, '21:00:00', '15:00:00', '2018-12-05', 0, 30),
(12, 'One Step forward', 'Travelling abroad', 'Nile University', 4000, '06:00:00', '20:00:00', '2018-05-13', 0, NULL);

INSERT INTO `event_gallary` (`id`, `url`, `event_id`) VALUES
(28, '00_1525599930.jpg', 11),
(29, '4144_1525599930.jpg', 11),
(30, '0_1525599930.jpg', 11);

INSERT INTO `highboards` (`member_id`) VALUES
(6),
(6);

INSERT INTO `hih` (`date_of_foundation`, `college_id`, `mission`, `vision`, `founder`, `president_id`, `id_of_members`) VALUES
('2018-05-06 07:53:43', '1', 'we aim to build a new generation of the Egyptian Youth and be like UNICEF', 'Be a multinational non profit organization', 'Omar Touny', 2, 0),
('2018-05-06 07:53:43', '1', 'we aim to build a new generation of the Egyptian Youth and be like UNICEF', 'Be a multinational non profit organization', 'Omar Touny', 2, 0);

INSERT INTO `member` (`id`, `no_of_Rewards`, `Rate`, `committee_id`, `workshop_id`) VALUES
(3, NULL, NULL, 17, 0),
(4, NULL, NULL, NULL, 0),
(5, NULL, NULL, NULL, 0),
(6, NULL, NULL,17, 0),
(7, NULL, NULL,19, 0),
(8, NULL, NULL,20, 0),
(9, NULL, NULL,NULL, 0),
(10, NULL, NULL,NULL, 0),
(11, NULL, NULL,NULL, 0),
(12, NULL, NULL,NULL, 0),
(13, NULL, NULL,NULL, 0);

INSERT INTO `messages` (`id`, `content`, `receiver`, `sender`, `seen`, `created_at`, `updated_at`) VALUES
(45, 'first message', 3, 2, 0, '2018-05-02 01:04:10', '2018-05-02 01:04:10'),
(46, 'hello', 2, 5, 1, '2018-05-02 01:10:11', '2018-05-06 08:57:21'),
(47, 'hi', 2, 5, 1, '2018-05-02 01:10:40', '2018-05-06 08:57:21'),
(48, 'hi', 5, 2, 1, '2018-05-02 09:42:20', '2018-05-06 08:57:13'),
(49, 'nfvd', 5, 2, 1, '2018-05-02 09:44:31', '2018-05-06 08:57:13'),
(50, 'dfvjd', 2, 5, 1, '2018-05-02 09:44:40', '2018-05-06 08:57:21'),
(51, 'Hi hossam', 2, 5, 1, '2018-05-02 10:03:37', '2018-05-06 08:57:21'),
(52, 'fdjbvdf', 5, 2, 1, '2018-05-02 10:04:02', '2018-05-06 08:57:13'),
(53, 'dbfjbv', 5, 2, 1, '2018-05-02 10:04:04', '2018-05-06 08:57:13'),
(54, 'jdfvj', 5, 2, 1, '2018-05-02 10:04:05', '2018-05-06 08:57:13'),
(55, 'bjfbg', 5, 2, 1, '2018-05-02 10:04:07', '2018-05-06 08:57:13'),
(56, 'gfb', 5, 2, 1, '2018-05-02 10:04:10', '2018-05-06 08:57:13'),
(57, 'fgb', 5, 2, 1, '2018-05-02 10:04:12', '2018-05-06 08:57:13'),
(58, 'dfvdfvdf', 5, 2, 1, '2018-05-02 10:04:15', '2018-05-06 08:57:13'),
(59, 'dfbvdf', 2, 5, 1, '2018-05-02 10:05:31', '2018-05-06 08:57:21'),
(60, 'fdvgfb', 5, 2, 1, '2018-05-02 10:14:55', '2018-05-06 08:57:13'),
(61, 'fgblsdc', 5, 2, 1, '2018-05-02 10:14:59', '2018-05-06 08:57:13'),
(62, 'fvrl;vmnrjenv rjk jrv jr js nc  fns vjk serjv', 5, 2, 1, '2018-05-02 10:17:02', '2018-05-06 08:57:13'),
(69, 'hi', 2, 6, 1, '2018-05-02 12:31:19', '2018-05-06 08:54:49'),
(70, 'hi 2', 2, 6, 1, '2018-05-02 12:34:05', '2018-05-06 08:54:49'),
(71, 'hello', 2, 6, 1, '2018-05-02 13:28:27', '2018-05-06 08:54:49'),
(72, 'sorry, i was busy', 6, 2, 1, '2018-05-02 13:28:58', '2018-05-06 08:54:53'),
(73, 'never mind <3', 2, 6, 1, '2018-05-02 13:29:07', '2018-05-06 08:54:49'),
(74, 'thanks', 6, 2, 1, '2018-05-02 13:29:34', '2018-05-06 08:54:53'),
(75, 'does everything work correctly ?', 2, 6, 1, '2018-05-02 13:30:48', '2018-05-06 08:54:49'),
(76, 'اه ياسطا <3 ... حاجه الاجا الصراحه', 6, 2, 1, '2018-05-02 13:31:08', '2018-05-06 08:54:53'),
(77, 'ooooh, you can speak arabic !', 2, 6, 1, '2018-05-02 13:31:38', '2018-05-06 08:54:49'),
(78, 'yes, i\'m شبح', 6, 2, 1, '2018-05-02 13:31:57', '2018-05-03 23:07:37'),
(79, 'lol', 2, 6, 1, '2018-05-02 13:32:09', '2018-05-06 08:54:49'),
(80, 'hi', 11, 2, 0, '2018-05-02 16:00:09', '2018-05-02 16:00:09'),
(81, 'surprise', 2, 5, 1, '2018-05-02 18:12:45', '2018-05-06 08:57:21'),
(82, 'hi', 2, 7, 1, '2018-05-02 18:14:33', '2018-05-06 08:54:11'),
(83, 'surprise2', 2, 5, 1, '2018-05-02 18:15:27', '2018-05-06 08:57:21'),
(84, 'dbf', 2, 5, 1, '2018-05-03 10:37:20', '2018-05-06 08:57:21'),
(85, 'hng', 5, 2, 1, '2018-05-03 10:37:44', '2018-05-06 08:57:13'),
(86, 'hgnfbd', 5, 2, 1, '2018-05-03 10:37:46', '2018-05-06 08:57:13'),
(87, 'dgfr', 5, 2, 1, '2018-05-03 10:37:48', '2018-05-06 08:57:13'),
(88, 'hi', 2, 6, 1, '2018-05-03 10:38:13', '2018-05-06 08:54:49'),
(89, 'surprise', 2, 7, 1, '2018-05-03 22:29:39', '2018-05-06 08:54:11'),
(90, 'hi', 2, 5, 1, '2018-05-03 22:34:22', '2018-05-06 08:57:21'),
(91, 'dfvdfv', 2, 5, 1, '2018-05-03 22:34:35', '2018-05-06 08:57:21'),
(92, 'dfvfb', 5, 2, 1, '2018-05-03 22:34:38', '2018-05-06 08:57:13'),
(93, 'gfbgfb', 5, 2, 1, '2018-05-03 22:34:40', '2018-05-06 08:57:13'),
(94, 'gfbf', 2, 5, 1, '2018-05-03 22:34:43', '2018-05-06 08:57:21'),
(95, 'gb', 2, 5, 1, '2018-05-03 22:34:44', '2018-05-06 08:57:21'),
(96, 'gfbgfb', 5, 2, 1, '2018-05-03 22:34:46', '2018-05-06 08:57:13'),
(97, 'fgbgfb', 2, 5, 1, '2018-05-03 22:34:49', '2018-05-06 08:57:21'),
(98, 'fgb,g', 5, 2, 1, '2018-05-03 22:34:52', '2018-05-06 08:57:13'),
(99, 'fgbgf', 2, 5, 1, '2018-05-03 22:34:55', '2018-05-06 08:57:21'),
(100, 'fgb,gf', 5, 2, 1, '2018-05-03 22:34:58', '2018-05-06 08:57:13'),
(101, 'gfbgfb', 5, 2, 1, '2018-05-03 22:35:02', '2018-05-06 08:57:13'),
(102, 'fgb', 2, 5, 1, '2018-05-03 22:35:04', '2018-05-06 08:57:21'),
(103, 'fg', 2, 5, 1, '2018-05-03 22:35:06', '2018-05-06 08:57:21'),
(104, 'gfbgf', 5, 2, 1, '2018-05-03 22:35:09', '2018-05-06 08:57:13'),
(105, 'gfb', 2, 5, 1, '2018-05-03 22:35:14', '2018-05-06 08:57:21'),
(106, 'fg', 2, 5, 1, '2018-05-03 22:35:16', '2018-05-06 08:57:21'),
(107, 'lsmvf', 2, 7, 1, '2018-05-03 23:01:29', '2018-05-06 08:54:11'),
(108, 'fvdfv', 2, 7, 1, '2018-05-03 23:04:25', '2018-05-06 08:54:11'),
(109, 'fdvdfv', 2, 7, 1, '2018-05-03 23:05:00', '2018-05-06 08:54:11'),
(110, 'dfvgb', 2, 7, 1, '2018-05-03 23:05:15', '2018-05-06 08:54:11'),
(111, 'gfbfbfg', 2, 5, 1, '2018-05-03 23:05:50', '2018-05-06 08:57:21'),
(112, 'gfbfb', 2, 5, 1, '2018-05-03 23:05:58', '2018-05-06 08:54:57'),
(113, 'hi', 2, 6, 1, '2018-05-03 23:06:27', '2018-05-06 08:54:49'),
(114, 'dfv', 5, 2, 1, '2018-05-03 23:06:49', '2018-05-06 08:57:13'),
(115, 'hi', 2, 6, 1, '2018-05-03 23:07:02', '2018-05-06 08:54:49'),
(116, 'fbg', 2, 7, 1, '2018-05-04 06:50:30', '2018-05-06 08:54:11'),
(117, 'kjdbs', 7, 2, 0, '2018-05-06 08:54:10', '2018-05-06 08:54:10'),
(118, 'sxkjds', 6, 2, 0, '2018-05-06 08:54:47', '2018-05-06 08:54:47'),
(119, 'sdjjshcs', 5, 2, 1, '2018-05-06 08:54:56', '2018-05-06 08:57:13'),
(120, 'Hiiiiiiiiiii', 2, 5, 0, '2018-05-06 08:57:05', '2018-05-06 08:57:05');

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('dscd@yahoo.com', '$2y$10$aTONlmWrANPz//lXBBKlnOPnuRlUfEvKtNNy0x9yXBad7w5N5LrWC', '2018-04-28 14:52:45'),
('member2@hih.com', '$2y$10$aX9qaePesE4NshVy7Fvu8.ZYQPvou2aquOJVaIMpW52B/yl0Kx0Uu', '2018-04-28 14:59:31'),
('8jokex30k@tmail.ws', '$2y$10$u4frRA/asbQYvObCilYE7OinEVNwBPy9JIS3uCc.mMn8ZcGF91F5K', '2018-04-28 15:24:23'),
('dscd@yahoo.com', '$2y$10$aTONlmWrANPz//lXBBKlnOPnuRlUfEvKtNNy0x9yXBad7w5N5LrWC', '2018-04-28 14:52:45'),
('member2@hih.com', '$2y$10$aX9qaePesE4NshVy7Fvu8.ZYQPvou2aquOJVaIMpW52B/yl0Kx0Uu', '2018-04-28 14:59:31'),
('8jokex30k@tmail.ws', '$2y$10$u4frRA/asbQYvObCilYE7OinEVNwBPy9JIS3uCc.mMn8ZcGF91F5K', '2018-04-28 15:24:23');

INSERT INTO `sessiontimeline` (`workshop_id`, `session_number`, `date_of_session`, `to`, `from`) VALUES
(4, 0, '2018-10-12', '00:00:00', '12:00:00');

INSERT INTO `speaker` (`id`, `title`, `phone_number`, `fields_of_interest`, `email`, `first_name`, `last_name`, `about`, `photo_url`) VALUES
(5, 'Ms', '01017993044', 'Life coaching', 'aya_hamza@gmail.com', 'Aya', 'Hamza', 'She is a great life coach who helps you to get better and manage your time', '12_1525605221.jpg');

INSERT INTO `sponsor` (`id`, `name`, `email`, `phone_number`, `photo_url`, `about`) VALUES
(1, 'el_asly', 'el_asly@gmail.com', '01017993046', '9_1525604874.jpg', 'Multinational company');

INSERT INTO `tasks` (`id`, `content`, `receiver`, `sender`, `answer`, `seen`, `created_at`, `updated_at`, `seen_at`, `answered`) VALUES
(1, 'Make a deal with Mo Salah', 2, 2, 1, 0, '2018-05-06 08:49:38', '2018-05-06 08:50:45', NULL, 1),
(2, 'dhjsb', 5, 2, 0, 1, '2018-05-06 08:53:10', '2018-05-06 08:56:27', '2018-05-06 08:56:22', 1);

INSERT INTO `university` (`id`, `name`) VALUES
(1, 'Cairo University'),
(2, 'Ain Shams University');

INSERT INTO `users` (`id`, `username`, `type`, `id_of`, `password`, `first_name`, `last_name`, `email`, `phone_number`, `photo_url`, `college_id`, `remember_token`, `about`) VALUES
(2, 'samir7osny', 0, 3, '$2y$10$QCD4rXEryEyn.lo0/dwtwemT5mEzYo5veEnY6o4Dg6ZzfLXfKgQyi', 'Samir', 'Hosny Mohamed', 'samir7osny@yahoo.com', '01149342966', '12_1525596724.jpg', 5, 'jGay2ZQRdOi7DdHpQdTi3x9vcS4uzX5Dht1AWk4aypBvCsHqeJh0VQjctmry', NULL),
(3, 'tomhanksbrdo', 0, 4, '$2y$10$4K6GKUj9kUSGMhiXGrTMoOdiczsq.80Kw9V.f/gxVXIV2ygJuSNXq', 'Tom', 'Hanks Brdo', 'tomhanksbrdo@hih.com', '01146626261', 'Tom-Hanks-spotted-on-the-set-of-Sully_1522988703.jpg', 9, 'Ph7nWVtuLBqmda6hQgufG1q6TXzxergWFOX3uOJqOetsWTvw1FMGVbzPGKpD', 'bg m n knf lmflm fn kf ;lmkfnmmvlfm fk vnbg m n knf lmflm fn kf ;lmkfnmmvlfm fk vnbg m n knf lmflm fn kf ;lmkfnmmvlfm fk vnbg m n knf lmflm fn kf ;lmkfnmmvlfm fk vnbg m n knf lmflm fn kf ;lmkfnmmvlfm fk vnbg m n knf lmflm fn kf ;lmkfnmmvlfm fk vnbg m n knf lmflm fn kf ;lmkfnmmvlfm fk vnbg m n knf lmflm fn kf ;lmkfnmmvlfm fk vnbg m n knf lmflm fn kf ;lmkfnmmvlfm fk vnbg m n knf lmflm fn kf ;lmkfnmmvlfm fk vnbg m n knf lmflm fn kf ;lmkfnmmvlfm fk vnbg m n knf lmflm fn kf ;lmkfnmmvlfm fk vnbg m n knf lmflm fn kf ;lmkfnmmvlfm fk vnbg m n knf lmflm fn kf ;lmkfnmmvlfm fk vnbg m n knf lmflm fn kf ;lmkfnmmvlfm fk vnbg m n knf lmflm fn kf ;lmkfnmmvlfm fk vnbg m n knf lmflm fn kf ;lmkfnmmvlfm fk vnbg m n knf lmflm fn kf ;lmkfnmmvlfm fk vnbg m n knf lmflm fn kf ;lmkfnmmvlfm fk vn'),
(4, 'fvfv', 0, 5, '$2y$10$AVCZ5BNhJRxsdEOmfRKrAuRQT2WwpthWClY0If29r717n1KThcQ/6', 'fvfv', 'fvfv', 'fvf@yahoo.com', '01149342960', 'tom-hanks-2017_1523156505.jpg', 2, NULL, 'fvfdv'),
(5, 'member1', 0, 6, '$2y$10$OacC9jWlELoUw3UeEgm3eeHI0A/3FL5JwwigR7U1Vtpg1zzXg2f9i', 'Omar', 'Touny', 'omartouny2@gmail.com', '01017993046', 'cover(1)_1525596571.jpg', 1, 'uAytBZ6slC93HlGwXuPweY6LU7i2DRRQgjbKKi0FqJhg1f0R7QCHdYcil1EI', '2nd year computer department.'),
(6, 'member2', 0, 7, '$2y$10$wK1Wl0Vs2aOnTWq.5dWXwOgeXOlz.U5kqH5MzjhcntTcOsE5qMLpS', 'member', '2', 'member2@hih.com', '01149342901', '070714_trending_hanks_hulu_1523156469.jpg', 2, 'zRO5jmzWOLTYTxKb0IYc1kEV0AEKDbNr7FBhhKxoNn7oNZH1vpAjyrEW3nlx', 'fvfdv fdv fdxv fdv dfv ffdv fv fdv fvd fv\r\nf.vmnbj hkfmv\r\nfmnhdvjnmd;f jfvnmkdfl,v'),
(7, 'member3', 0, 8, '$2y$10$zo6E2TqJ40MF/.hUhlPSS.umtfg.CDDrzU/VVkpNzrkzemZSPtksG', 'member', '3', 'member3@hih.com', '01149342902', '649379_1523136315.jpg', 8, '3cHbQmBicELu0H96gIEY1ZoPCNEGqdASKBsNHHk76HO56T4tyZfmF3nUEaEp', 'fvfdv fdv fdxv fdv dfv ffdv fv fdv fvd fv\r\nf.vmnbj hkfmv\r\nfmnhdvjnmd;f jfvnmkdfl,v'),
(8, 'member4', 0, 9, '$2y$10$R/Da6n5EUmer7o41k01Qku9rrnoZrkuPu0bbLMuqVyNdaCLQrl3zy', 'member', '4', 'member4@hih.com', '01149342903', '334631_1523136351.jpg', 4, NULL, 'fvfdv fdv fdxv fdv dfv ffdv fv fdv fvd fv\r\nf.vmnbj hkfmv\r\nfmnhdvjnmd;f jfvnmkdfl,v'),
(9, 'member5', 0, 10, '$2y$10$/qMuzxbjEndlg6i/8XfpuuA0OICrX8DJhq0z/gW7ROVzHu/dXFfiC', 'member', '5', 'member5@hih.com', '01146626205', '484224 - 1_1523156448.jpg', 5, 'iB4U6MrFrVAYuum2IxCRok7ZwjyZRYmX2o9mZJxWrq6tbqRhBhDqgMVvjtvO', 'fbgvbgfb gfb gfb z'),
(10, 'tomhanksbrdo2', 0, 11, '$2y$10$XIzJ3Zr/W9xp0paD7NZt4eSuwHKPl44eJGKYKZa.WvS8XD9izy0Be', 'tom', 'hanks bardo 2', 'tomhanksbrdo2@hih.com', '01149342000', 'user.jpg', 5, NULL, 'nkjdfv fdkbng bklgnb gfb'),
(11, 'omar', 0, 12, '$2y$10$mV.YMVGpd1IJSRzIeQ1gAOudhDmU08C1q7AWDmyd7jIfWpijMqVVW', 'Om', 'bjdfvkfsv', 'dfghjkhg@hjgfh.com', '01149300960', 'bdde25511f6ad236a15dc37533487f51_1523779716.jpg', 3, NULL, 'jksdv jfndv dfjn'),
(12, 'create', 0, 13, '$2y$10$ggGLYWTCCBoVafX.ckdJjOigBEQEJcwnP.I/bWdSgKZ0aI0oY5th6', 'vfidk', 'nkfmvd', 'dscd@yahoo.com', '01146626245', 'user.jpg', 8, 'wPo0lkEFHmVBdbiOWeQYH2lLBSPZCtqrpqdjFkIUFZyPTXbE7lz8OPCCdFE1', NULL);

INSERT INTO `workshop` (`id`, `name`, `description`, `cost`, `place_cost`, `place`, `cover_id`) VALUES
(4, 'Child Project', 'Give a better education for the Egyptian children', 0, 0, 'El-Malek L-Sale7', 13);

INSERT INTO `workshop_gallary` (`id`, `url`, `workshop_id`) VALUES
(13, 'd_1525600266.jpg', 4);

ALTER TABLE `college`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

ALTER TABLE `committee`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

ALTER TABLE `committees_codes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `deleting_request`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `event`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

ALTER TABLE `event_gallary`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

ALTER TABLE `guest`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `member`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

ALTER TABLE `speaker`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `sponsor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `tasks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `university`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

ALTER TABLE `workshop`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `workshop_gallary`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;