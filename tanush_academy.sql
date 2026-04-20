-- ============================================================
-- Tanush Academy - Database Schema & Sample Data
-- Run this file in phpMyAdmin or MySQL CLI to set up the DB
-- ============================================================

CREATE DATABASE IF NOT EXISTS tanush_academy CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE tanush_academy;

-- -------------------------------------------------------
-- Table: users
-- Stores registered student accounts
-- -------------------------------------------------------
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- -------------------------------------------------------
-- Table: notes
-- Stores all study material records
-- Categories: government_exam, computer_course, shorthand
-- -------------------------------------------------------
CREATE TABLE IF NOT EXISTS notes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    description TEXT,
    file_path VARCHAR(500),
    category VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- -------------------------------------------------------
-- Sample Notes Data
-- -------------------------------------------------------
INSERT INTO notes (title, description, file_path, category) VALUES
-- Government Exam Notes
('UPSC Indian Polity Notes',       'Comprehensive notes covering Constitution, Parliament, Judiciary, and Federalism for UPSC Civil Services preparation.',      '#', 'government_exam'),
('UPSC History & Culture',         'Ancient, Medieval and Modern Indian History with art & culture topics for UPSC Mains and Prelims.',                         '#', 'government_exam'),
('SSC General Knowledge Pack',     'Important GK topics covering Science, Geography, Economy and Current Affairs for SSC CGL/CHSL exams.',                      '#', 'government_exam'),
('SSC Math Shortcuts',             'Quick formulas and tricks for Quantitative Aptitude - Percentage, Ratio, Time & Work, Speed.',                              '#', 'government_exam'),
('Banking Awareness Notes',        'Banking sector awareness covering RBI, monetary policy, financial markets for IBPS PO/Clerk and SBI exams.',                '#', 'government_exam'),
('Banking Reasoning Guide',        'Logical Reasoning and Verbal Ability guide tailored for bank recruitment examinations.',                                     '#', 'government_exam'),
('Railway GK Capsule',             'Compact General Knowledge capsule specifically curated for RRB NTPC, Group D and JE exams.',                                '#', 'government_exam'),
('Railway Science Notes',          'General Science notes covering Physics, Chemistry and Biology for Railway recruitment board exams.',                         '#', 'government_exam'),

-- Computer Course Notes
('Computer Fundamentals',          'Basic computer concepts: hardware, software, operating systems, input/output devices and memory explained simply.',          '#', 'computer_course'),
('MS Word Complete Guide',         'Step-by-step MS Word tutorial covering formatting, tables, mail merge, macros and document templates.',                      '#', 'computer_course'),
('MS Excel Formulas & Functions',  'Excel guide covering SUM, VLOOKUP, IF, PIVOT tables, charts and data analysis tools with examples.',                        '#', 'computer_course'),
('MS PowerPoint Presentation',     'Design and presentation techniques in PowerPoint including animations, transitions and slide masters.',                      '#', 'computer_course'),
('HTML & CSS Basics',              'Introduction to web development with HTML5 and CSS3 - tags, attributes, selectors, flexbox and responsive design.',         '#', 'computer_course'),
('JavaScript for Beginners',       'Core JavaScript fundamentals: variables, functions, DOM manipulation, events and basic ES6+ syntax.',                       '#', 'computer_course'),

-- Shorthand Notes
('Pitman Shorthand - Beginner',    'Introduction to Pitman Shorthand: strokes, vowels, consonants, and basic word outlines for complete beginners.',            '#', 'shorthand'),
('Shorthand Speed Building',       'Exercises and dictation passages to improve your shorthand writing speed from 40 to 100+ words per minute.',               '#', 'shorthand'),
('Shorthand Common Phrases',       'Most frequently used phrases and abbreviations in Pitman Shorthand for office and court reporting.',                        '#', 'shorthand'),
('Shorthand Practice Passages',    'A collection of practice passages at varying speeds (60, 80, 100 WPM) for examination preparation.',                        '#', 'shorthand');
