CREATE TABLE authors (
  id SERIAL PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO authors (name) VALUES
('Albert Einstein'),
('Confucius'),
('Mark Twain'),
('Kanye West'),
('Friedrich Nietzsche');

CREATE TABLE IF NOT EXISTS categories (
  id SERIAL PRIMARY KEY,
  category VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO categories (category) VALUES
('Inspirational'),
('Faith'),
('Funny'),
('Poetry'),
('Success');

CREATE TABLE IF NOT EXISTS quotes (
  id SERIAL PRIMARY KEY,
  quote TEXT NOT NULL,
  author_id INT NOT NULL,
  category_id INT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (author_id) REFERENCES authors(id),
  FOREIGN KEY (category_id) REFERENCES categories(id)
);

INSERT INTO quotes (quote, author_id, category_id) VALUES
('We cannot solve our problems with the same thinking we used when we created them.', 1, 1),
('Life is like riding a bicycle. To keep your balance, you must keep moving.', 1, 1),
('Learn from yesterday, live for today, hope for tomorrow. The important thing is not to stop questioning.', 1, 4),
('Logic will get you from A to B. Imagination will take you everywhere.', 1, 1),
('The only source of knowledge is experience.', 1, 5),
('To know what you know and what you do not know, that is true knowledge.', 2, 4),
('The will to win, the desire to succeed, the urge to reach your full potential... these are the keys that will unlock the door to personal excellence.', 2, 5),
('Never give a sword to a man who cant dance.', 2, 4),
('When anger rises, think of the consequences.', 2, 1),
('Success depends upon previous preparation, and without such preparation there is sure to be failure.', 2, 5),
('It is better to keep your mouth closed and let people think you are a fool than to open it and remove all doubt.', 3, 1),
('If you tell the truth, you dont have to remember anything.', 3, 1),
('Get your facts first, then you can distort them as you please.', 3, 3),
('Age is an issue of mind over matter. If you dont mind, it doesnt matter.', 3, 3),
('The secret of getting ahead is getting started.', 3, 1),
('I love sleep; its my favorite.', 4, 3),
('For me, money is not my definition of success. Inspiring people is a definition of success.', 4, 5),
('I still think I am the greatest.', 4, 1),
('We came into a broken world. And were the cleanup crew.', 4, 1),
('Nobody can tell me where I can and cant go.', 4, 1),
('That which does not kill us makes us stronger.', 5, 3),
('Hope in reality is the worst of all evils because it prolongs the torments of man.', 5, 4),
('Without music, life would be a mistake.', 5, 3),
('It is not a lack of love, but a lack of friendship that makes unhappy marriages.', 5, 2),
('One must still have chaos in oneself to be able to give birth to a dancing star.', 5, 2);
