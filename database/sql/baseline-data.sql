-- Insert some baseline data into EXPERIMENT
INSERT INTO EXPERIMENT(ACRONYM, FULL_NAME, ADDRESS)
VALUES
    ('ATLAS', 'A Toroidal LHC ApparatuS', '1 Esplanade des Particules, 1217 Meyrin, Switzerland'),
    ('LHCb', 'Large Hadron Collider beauty', '10 Chemin du Bois Candide, 01210 Ferney-Voltaire, France'),
    ('ALICE', 'A Large Ion Collider Experiment', '245 Chemin des Grands Prés, 01630 Sergy, France');

-- Insert some baseline data into MEMBER
INSERT INTO MEMBER(FIRST_NAME, LAST_NAME, EMAIL, AGE, EXPERIMENT_ID)
VALUES
    ('Erik', 'Pearson', 'erik@cern.ch', 38, 3),
    ('Mary', 'Ann', 'mary@cern.com', 20, 2),
    ('John', 'Doe', 'johndoe@cern.ch', 24, 1);