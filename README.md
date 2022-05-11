# RYS

## Security.yaml

in  config\packages\Security.yaml
Add the following code

```yaml
access_control:
    - { path: ^/admin, roles: [ROLE_ADMIN,ROLE_EMPLOYEE_RH,ROLE_EMPLOYEE_PM] }
    - { path: ^/profil, roles: [ROLE_EMPLOYEE,ROLE_ADMIN,ROLE_EMPLOYEE_RH,ROLE_EMPLOYEE_PM] }
    - { path: ^/Project, roles: [ROLE_ADMIN,ROLE_EMPLOYEE_PM] }
    - { path: ^/employees, roles: [ROLE_ADMIN,ROLE_EMPLOYEE_RH] }
role_hierarchy:

    ROLE_EMPLOYEE: ROLE_USER
    ROLE_EMPLOYEE_RH: ROLE_EMPLOYEE
    ROLE_EMPLOYEE_PM: ROLE_EMPLOYEE
    ROLE_ADMIN: [ROLE_EMPLOYEE_RH,ROLE_EMPLOYEE_PM]
```