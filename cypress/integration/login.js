it('Logs in users', () => {
    cy.create('App\\Models\\User').then(user => {
        cy.visit('/login');

        cy.get('input[name="email"]').type(user.email);
        cy.get('input[name="password"]').type('password');
        cy.get('button[type="submit"]').click();

        cy.visit('/');
        cy.contains(user.first_name);
    });
});
