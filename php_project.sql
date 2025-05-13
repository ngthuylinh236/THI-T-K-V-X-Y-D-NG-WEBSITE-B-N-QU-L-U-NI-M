-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 05, 2025 lúc 05:19 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `php_project`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contact`
--

CREATE TABLE `contact` (
  `contact_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_phone` varchar(15) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date` date DEFAULT NULL,
  `contact_status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `contact`
--

INSERT INTO `contact` (`contact_id`, `user_name`, `user_phone`, `user_email`, `content`, `date`, `contact_status`) VALUES
(600, 'Nguyễn Văn Anh', '0912345678', 'nguyenvana@gmail.com', 'Tôi muốn tìm hiểu thêm về sản phẩm của bạn.', '2024-12-16', 'Mới'),
(601, 'Trần Thị Bình', '0938765432', 'tranthib@gmail.com', 'Vui lòng hỗ trợ tôi về vấn đề đặt hàng.', '2024-12-15', 'Đang xử lý'),
(602, 'Lê Hoàng Cảnh', '0987654321', 'lehoangc@gmail.com', 'Tôi cần thêm thông tin về bảo hành sản phẩm.', '2024-12-14', 'Đã phản hồi'),
(603, 'Ngô Văn Chính', '0976543210', 'ngovanf@gmail.com', 'Hóa đơn của tôi bị sai, vui lòng kiểm tra.', '2024-12-11', 'Đang xử lý'),
(604, 'Lý Thị Huyên', '0932456789', 'lythih@gmail.com', 'Khi nào thì sản phẩm tôi đặt sẽ được giao?', '2024-12-09', 'Đang xử lý'),
(605, 'Dương Thanh Hương', '0965432178', 'duongthanhj@gmail.com', 'Hệ thống của bạn có vẻ bị lỗi khi tôi đặt hàng.', '2024-12-07', 'Đã phản hồi'),
(606, 'Linh Nguyễn', '0582590020', 'ngthuylinh236@gmail.com', 'Tôi muốn ăn thịt gà', '2024-01-23', 'Đang xử lý');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_status` varchar(100) NOT NULL DEFAULT 'on_hold',
  `user_id` int(11) NOT NULL,
  `user_phone` varchar(15) NOT NULL,
  `user_city` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `order_cost` decimal(10,0) NOT NULL,
  `order_payment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`order_id`, `order_status`, `user_id`, `user_phone`, `user_city`, `user_address`, `order_date`, `order_cost`, `order_payment`) VALUES
(318, 'Đang chờ', 100, '0582590020', 'Hưng Yên', 'Quan Cù- Phan Đình Phùng- Mỹ Hào- Hưng Yên', '2024-12-17 00:00:00', 51000, 'bank'),
(319, 'Đã giao', 100, '0582590020', 'Hưng Yên', 'Quan Cù- Phan Đình Phùng- Mỹ Hào- Hưng Yên', '2024-12-25 00:00:00', 57000, 'cod'),
(320, 'Đang chờ', 100, '0582590020', 'Hưng Yên', 'Quan Cù- Phan Đình Phùng- Mỹ Hào- Hưng Yên', '2025-01-05 00:00:00', 50000, 'bank');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `product_name` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_items`
--

INSERT INTO `order_items` (`item_id`, `order_id`, `product_id`, `user_id`, `order_date`, `product_name`, `product_image`, `product_quantity`, `product_price`) VALUES
(439, 318, 223, 100, '2024-12-17 00:00:00', 'Thiệp chúc mừng vintage', 'j.jpg', 1, 6000),
(440, 318, 225, 100, '2024-12-17 00:00:00', 'Hộp quà tặng ô kính thắt nơ', 'k.jpg', 1, 45000),
(441, 319, 201, 100, '2024-12-25 00:00:00', 'Túi quà giáng sinh cửa sổ', 'tuiquagiangsinh.jpg', 3, 19000),
(442, 320, 202, 100, '2025-01-05 00:00:00', 'Mèo thần tài mini Hạnh phúc viên mãn', 'meothantai.jpg', 1, 50000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_supplier` varchar(255) DEFAULT NULL,
  `product_stock` int(11) DEFAULT 0,
  `product_category` varchar(100) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_image1` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_image2` varchar(255) NOT NULL,
  `product_image3` varchar(255) NOT NULL,
  `product_image4` varchar(255) NOT NULL,
  `product_price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_supplier`, `product_stock`, `product_category`, `product_description`, `product_image1`, `product_image`, `product_image2`, `product_image3`, `product_image4`, `product_price`) VALUES
(200, 'Cốc sứ hoa văn khu vườn châu Âu', 'Công ty Quà Tặng Hoàng Kim', 35, 'Quà sinh nhật', '- Chất liệu: Gốm sứ tráng men\r\n\r\n- Kích thước: Chiều cao 10.2cm x Chiều rộng 12 cm x Đường kính miệng cốc 8.6 cm\r\n\r\n- Dung tích: 380ml\r\n\r\n- Bộ sản phẩm bao gồm: 1 cốc', 'coc1.png', 'coc.jpg', 'coc2.png', 'coc3.png', 'coc4.png', 135000),
(201, 'Túi quà giáng sinh cửa sổ', 'Công ty Quà Tặng Hoàng Kim', 30, 'Quà giáng sinh', '- Chất liệu: Bìa cứng dày đẹp; Túi có quai vải cầm tay; Mặt kính cửa sổ bằng nhựa.\n\n- Kích thước:\n\n- Size M: cao 26cm, dài 18cm, rộng 12cm\n\n- Size L: cao 30cm, dài 20cm, rộng 16cm\n\n- Túi hình hộp chữ nhật với hoạ tiết dễ thương cùng tông màu đỏ, xanh đậm ', 'tuiquagiangsinh1.jpg', 'tuiquagiangsinh.jpg', 'tuiquagiangsinh2.jpg', 'tuiquagiangsinh3.jpg', 'tuiquagiangsinh4.png', 19000),
(202, 'Mèo thần tài mini Hạnh phúc viên mãn', 'Công ty Quà Tặng Hoàng Kim', 11, 'Quà sinh nhật', '- Chất liệu: Mèo thần tài được làm từ nhựa Resin cao cấp, được chọn lựa kỹ càng, an toàn cho người sử dụng.\n\n- Kích thước: 6cm x 3.5cm x 5cm\n\n- Màu sắc: Mèo may mắn có màu trắng tượng trưng cho hạnh phúc và sự thuần khiết.', 'meothantai1.jpg', 'meothantai.jpg', 'meothantai2.jpg', 'meothantai3.jpg', 'meothantai4.jpg', 50000),
(203, 'Khung ảnh gỗ sồi phong cách Bắc Mỹ', 'Sản phẩm Quà Lưu Niệm Minh Tâm', 10, 'Quà valentine', '- Chất liệu: Gỗ sồi + Nhựa Mica trong suốt\n\n- Kích thước: 13 x 18cm\n\n', 'khunganh1.jpg', 'khunganh.jpg', 'khunganh2.jpg', 'khunganh3.jpg', 'khunganh4.jpg', 150000),
(204, 'Mô hình tivi tranh phát sáng ', 'Sản phẩm Quà Lưu Niệm Minh Tâm', 20, 'Quà sinh nhật', '- Chất liệu: Nhựa\n\n- Kích thước: Chiều dài 10 x chiều rộng 3.5 x chiều cao 9cm\n\n- Dung tích: 380ml\n\n- Dung lượng pin: 500 mAh\n\n- Thời gian dùng: 60-120 phút', 'tivi1.jpg', 'tivi.jpg', 'tivi2.jpg', 'tivi3.jpg', 'tivi4.jpg', 120000),
(205, 'Loa bluetooth kiêm đèn ngủ led', 'Sản phẩm Quà Lưu Niệm Minh Tâm', 30, 'Quà sinh nhật', '- Chất liệu: Nhựa ABS, linh kiện điện tử\n\n- Kích thước: Chiều cao 20,5 x chiều dài 12,4 x chiều rộng 9cm\n\n- Dung lượng pin: 1200mAh - có thể dùng kéo dài 6,5-72 giờ\n\n- Nguyên lý hoạt động: Đầu USB Type-C', 'loa1.jpg', 'loabluetooth.jpg', 'loa2.jpg', 'loa3.jpg', 'loa4.jpg', 480000),
(206, 'Hộp đèn thiên thần nhỏ trang trí', 'Nhà Sản Xuất Quà Tặng Sáng Tạo', 10, 'Quà sinh nhật', '- Chất liệu: Nhựa\n\n- Kích thước: Chiều cao 8.7 x chiều rộng 3.6 x chiều dài 4.8cm\n\n- Nguyên lý hoạt động: 3 pin LR41', 'hopdenthienthan1.jpg', 'hopdenthienthan.png', 'hopdenthienthan2.jpg', 'hopdenthienthan3.jpg', 'hopdenthienthan4.jpg', 90000),
(207, 'Tượng ông bà hiện đại - cầm hoa', 'Nhà Sản Xuất Quà Tặng Sáng Tạo', 7, 'Quà valentine', '- Chất liệu: Tượng ông bà được làm từ chất liệu tổng hợp giữa bột đá và bột nhựa.\r\n\r\n- Kích thước: 13 x 6 x 14.5cm\r\n\r\nBộ tượng khắc họa 1 cách tỉ mỉ chi tiết và tinh tế từ nét mặt, hình dáng đến từng cử chỉ, tạo nên 1 sản phẩm sinh động và chân thực.', 'tuongongba1.jpg', 'tuongongba.jpg', 'tuongongba2.jpg', 'tuongongba3.jpg', 'tuongongba4.jpg', 290000),
(208, 'Mô hình Heo con lắc lư Cute Pig', 'Nhà Sản Xuất Quà Tặng Sáng Tạo', 40, 'Quà sinh nhật', '- Chất liệu: Nhựa.\n\n- Kích thước: 7x7x6.8cm\n\nMô hình heo con lắc lư Cute Pig thích hợp trang trí bàn học, bàn làm việc, kệ tủ sách, tapo ô tô...', 'heo1.jpg', 'heo.jpg', 'heo2.jpg', 'heo3.jpg', 'heo4.jpg', 115000),
(209, 'Mô hình vịt con lắc lư Crazy Duck', 'Nhà Sản Xuất Quà Tặng Sáng Tạo', 50, 'Quà sinh nhật', '- Chất liệu: Nhựa.\n\n- Kích thước: 4.5x8.2cm\n\nMô hình trang trí với chú vịt vàng biểu cảm tinh nghịch ngộ nghĩnh, đầu lắc lư siêu đáng yêu.', 'mohinhvit1.jpg', 'mohinhvit.jpg', 'mohinhvit2.jpg', 'mohinhvit3.jpg', 'mohinhvit4.jpg', 90000),
(210, 'Đèn trang trí phi hành gia Cosmonaut', 'Công ty Quà Lưu Niệm Vĩnh Cửu', 20, 'Quà sinh nhật', '- Chất liệu: Nhựa.\n\n- Kích thước: 15x11.2x16.2cm\n\n- Đèn sử dụng 3 viên pin cúc áo loại nhỏ (có sẵn trong sp)', 'phihanhgia1.jpg', 'phihanhgia.jpg', 'phihanhgia2.jpg', 'phihanhgia3.jpg', 'phihanhgia4.jpg', 250000),
(211, 'Hộp nhạc gỗ hình trái tim', 'Công ty Quà Lưu Niệm Vĩnh Cửu', 15, 'Quà valentine', '- Chất liệu: Gỗ MDF\n\n- Kích thước: 11 x 10 x 5cm\n\n- Dung tích: 380ml\n\n- Trọng lượng: 300g\n\n- Bản nhạc: Đồng thoại, Hồ thiên nga (Swan Lake)', 'nhac1.jpg', 'nhac.jpg', 'nhac2.jpg', 'nhac3.jpg', 'nhac4.jpg', 280000),
(212, 'Hộp nhạc Piano pha lê', 'Công ty Quà Lưu Niệm Vĩnh Cửu', 19, 'Quà sinh nhật', '- Chất liệu: Pha lê\n\n- Kích thước: 14x13x10 cm\n\n- Nguyên tắc hoạt động của hộp nhạc pha lê Piano: Vặn cót dưới đáy đàn', 'phale1.jpg', 'phale.png', 'phale2.jpg', 'phale3.jpg', 'phale4.jpg', 395000),
(213, 'Quả cầu Ông già Noel ', 'Công ty Quà Lưu Niệm Vĩnh Cửu', 12, 'Quà giáng sinh', '- Chất liệu: Đế nhựa + quả cầu thủy tinh\n\n- Hộp nhạc size lớn: Đường kính quả cầu 10cm x chiều cao 17cm, có chế độ tuyết tự động kết hợp với đèn và nhạc\n\n- Hộp nhạc size nhỏ: Đường kính quả cầu 8cm x chiều cao 13cm, có chế độ đèn và nhạc', 'noel1.jpeg', 'noel.jpeg', 'noel2.jpg', 'noel3.jpeg', 'noel4.jpeg', 175000),
(214, 'Hộp nhạc quả cầu Ống khói', 'Công ty Quà Lưu Niệm Vĩnh Cửu', 9, 'Quà giáng sinh', '- Chất liệu: Đế nhựa + quả cầu thủy tinh\r\n\r\n- Hộp nhạc size lớn: Đường kính quả cầu 10cm x chiều cao 17cm, có chế độ tuyết tự động kết hợp với đèn và nhạc\r\n\r\n- Hộp nhạc size nhỏ: Đường kính quả cầu 8cm x chiều cao 13cm, có chế độ đèn và nhạc', 'a1.jpg', 'a.jpg', 'a2.jpg', 'a3.jpg', 'a4.jpg', 175000),
(215, 'Mèo vẫy tay Làm ăn Phát Tài', 'Quà Tặng Kim Ngọc', 13, 'Quà sinh nhật', '- Chất liệu: Mèo thần tài được làm từ gốm cao cấp\n\n- Kích thước: 20x20x21cm\n\n- Dung tích: 380ml\n\n- Màu sắc: Mèo thần tài có màu trắng tượng trưng cho hạnh phúc và sự thuần khiết.', 'b1.png', 'b.png', 'b2.png', 'b3.png', 'b4.png', 850000),
(216, 'Đèn ngủ silicon Thỏ Mập', 'Quà Tặng Kim Ngọc', 20, 'Quà sinh nhật', '- Chất liệu: ABS + silicone\n\n- Kích thước: 143x109x85mm\n\n- Màu sắc đèn: Trắng\n\n- Dung lượng pin: 1200 mAh (pin 18650)', 'c1.png', 'c.png', 'c2.png', 'c3.png', 'c4.png', 360000),
(217, 'Nến sáp thơm khu rừng Panda', 'Quà Tặng Kim Ngọc', 21, 'Quà sinh nhật', '- Chất liệu: Nến\n\n- Kích thước: Dài 21cm, Rộng 18cm, Cao 9 cm\n\n- Bộ sản phẩm gồm:\n\n1 Hũ nến thơm ống tre', 'd1.png', 'd.png', 'd2.png', 'd3.png', 'd4.png', 395000),
(218, 'Quà tặng luvgift', 'Quà Tặng Kim Ngọc', 14, 'Quà valentine', '- Kích thước: 20x20x7cm\n\n- Bộ sản phẩm gồm:\n\n1 Hộp quà kraft mặt kính trong suốt H13 màu đen, kèm túi kraft (V3)\n\n1 Nến thơm nghệ thuật Miền nhiệt đới\n\n2 Đôi tất màu xanh\n\n10 viên socola handmade nhân hạt quả khô - được đựng trong hộp kraft nắp cài nâu đe', 'e1.jpg', 'e.jpg', 'e2.jpg', 'e3.jpg', 'e4.jpg', 260000),
(219, 'Hộp quà hoa quả khô', 'Quà Tặng Kim Ngọc', 18, 'Quà valentine', '- Kích thước: 27 x 12 x 6cm\n\n- Bộ sản phẩm gồm:\n\nLọ hoa khô trong bình thủy tinh + 1 lọ tinh dầu thơm 10ml + hộp quà kraft mặt kính', 'f1.jpg', 'f.jpg', 'f2.jpg', 'f3.jpg', 'f4.jpg', 180000),
(220, 'Mô hình giấy đồ chơi', 'Hàng Quà Lưu Niệm Long Hưng', 31, 'Quà sinh nhật', '- Chất liệu: Giấy\n\n- Kích thước: 18x9x24.5cm\n\nMỗi set bao gồm: hộp quà + 9 miếng dán sticker + 9 quả bóng + dây treo (CHƯA BAO GỒM QUÀ TRONG MỖI QUẢ BÓNG)', 'g1.jpg', 'g.jpg', 'g2.jpg', 'g3.jpg', 'g4.jpg', 70000),
(221, 'Túi giấy đỏ hình Giáng Sinh', 'Hàng Quà Lưu Niệm Long Hưng', 11, 'Quà giáng sinh', '- Chất liệu: Giấy; Túi có quai cầm tay\n\n- Kích thước: 21x15x8cm\n\n- Màu sắc túi tươi tắn sinh động mang đậm không khí giáng sinh', 'h1.jpg', 'h.jpg', 'h2.jpg', 'h3.jpg', 'h4.jpg', 8000),
(222, 'Hộp quà nắp gài giáng sinh', 'Quà Lưu Niệm Thiên Long', 56, 'Quà giáng sinh', '- Chất liệu: Giấy bìa cứng; Túi có quai cầm tay\n\n- Kích thước: dài 25cm, rộng 20cm, cao 8cm\n\n- Hộp kèm sẵn rơm giấy màu ngẫu nhiên', 'i1.jpg', 'i.jpg', 'i2.jpg', 'i3.jpg', 'i4.jpg', 38000),
(223, 'Thiệp chúc mừng vintage', 'Công ty Quà Tặng Vàng Son', 65, 'Quà sinh nhật', '- Thiệp dạng gấp\n\n- Kích thước: 9 x 16cm (khi gập)\n\n- Mặt ngoài thiệp giấy được trang trí bởi sticker và hoa khô baby/ cỏ đuôi thỏ được giao ngẫu nhiên.', 'j1.png', 'j.jpg', 'j2.png', 'j3.png', 'j4.png', 6000),
(225, 'Hộp quà tặng ô kính thắt nơ', 'Công ty Quà Tặng Vàng Son', 43, 'Quà sinh nhật', '- Chất liệu: Hộp giấy.\n\n- Bộ sản phẩm gồm: 1 hộp + rơm giấy lót màu ngẫu nhiên + nơ voan + 1 tag giấy chữ \"A special gift\" (Chưa gồm túi đựng)', 'k1.png', 'k.jpg', 'k2.png', 'k3.png', 'k4.png', 45000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(108) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`) VALUES
(100, 'Linh Nguyễn', 'ngthuylinh236@gmail.com', 'e10adc3949ba59abbe56e057f20f883e');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `UX_Constraint` (`user_email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=607;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=321;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=443;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=238;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
