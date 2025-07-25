## F&MD - Testimonies

![Área Administrativa](https://github.com/agenciafmd/admix-testimonies/raw/v11/docs/01.png "Área Administrativa")

[![Downloads](https://img.shields.io/packagist/dt/agenciafmd/admix-testimonies.svg?style=flat-square)](https://packagist.org/packages/agenciafmd/admix-categories)
[![Licença](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)

- Depoimentos

## Instalação

```bash
sail composer require agenciafmd/admix-testimonies:v11.x-dev
```

Execute a migração

```bash
sail artisan migrate
```

Os seeds funcionarão diretamente do pacote. Caso precise de alguma customização, faça a publicação.

Não esqueça de corrigir os namespaces, paths das pastas e rodar o `sail composer dumpautoload` para que os arquivos
sejam
encontrados

```bash
sail artisan vendor:publish --tag=admix-testimonies:seeders
```

## Segurança

Caso encontre alguma falha de segurança, por favor, envie um e-mail para irineu@fmd.ag ao invés de abrir uma issue

## Créditos

- [Irineu Junior](https://github.com/irineujunior)

## Licença

Licença MIT. [Clique aqui](LICENSE.md) para mais detalhes