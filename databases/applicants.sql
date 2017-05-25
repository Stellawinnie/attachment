
ALTER TABLE `tbl_applicants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `companyName` (`companyName`),
  ADD KEY `userName` (`userName`),
  ADD KEY `postId` (`postId`);

--
-- Indexes for table `tbl_posts`
--
ALTER TABLE `tbl_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `companyName` (`companyName`);

--
-- Indexes for table `tbl_prof`
--
ALTER TABLE `tbl_prof`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `userName` (`userName`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `userEmail` (`userEmail`),
  ADD KEY `userName` (`userName`),
  ADD KEY `userID` (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_applicants`
--
ALTER TABLE `tbl_applicants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `tbl_posts`
--
ALTER TABLE `tbl_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tbl_prof`
--
ALTER TABLE `tbl_prof`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_applicants`
--
ALTER TABLE `tbl_applicants`
  ADD CONSTRAINT `foreignkeyapplicantusers` FOREIGN KEY (`userName`) REFERENCES `users` (`userName`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foreignkeycompanyusers` FOREIGN KEY (`companyName`) REFERENCES `users` (`userName`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foreignkeypostid` FOREIGN KEY (`postId`) REFERENCES `tbl_posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_posts`
--
ALTER TABLE `tbl_posts`
  ADD CONSTRAINT `foreignkeypostcompany` FOREIGN KEY (`companyName`) REFERENCES `users` (`userName`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_prof`
--
ALTER TABLE `tbl_prof`
  ADD CONSTRAINT `foreignkeyImageuser` FOREIGN KEY (`userName`) REFERENCES `users` (`userName`) ON DELETE CASCADE ON UPDATE CASCADE;
