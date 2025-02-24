-- add foreign key from users to todos
ALTER TABLE todos
ADD COLUMN user_id INT NOT NULL,
ADD CONSTRAINT fk_todos_users FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE;

-- add foreign key from todos to categories
ALTER TABLE todos
ADD COLUMN category_id INT NOT NULL,
ADD CONSTRAINT fk_todos_categories FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE RESTRICT;

-- add foreign key from users to categories
ALTER TABLE categories
ADD COLUMN user_id INT NOT NULL,
ADD CONSTRAINT fk_categories_users FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE;
