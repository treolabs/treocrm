## What is TreoCRM?
TreoCRM is an open-source CRM System, which is based on TreoCore Software platform and is developed by TreoLabs GmbH. TreoCRM is distributed under GPLv3 License and is free. TreoCRM is a true alternative to such open source CRM systems as SugarCRM, SuiteCRM, OroCRM or Vtiger.

TreoCRM is a single page application (SPA) with an API-centric, service-oriented architecture and flexible data model based on configurable entities and relations. In TreoCRM you can organize any data and business processes in terms of CRM and outside of its scope, if needed.

TreoCRM is a fork of EspoCRM, which comes with more advanced features and is more flexible for extensive software development. The main differences to EspoCRM are: 
* more flexible core 
* more advanced filters on list views
* module manager based on composer technology
* anchor navigation on all detail views
* UI optimized for smartphones and tablets
* configurable two-level navigation
* colored enum and multi-enum field types
* existence of owners for entity exemplars
* and more...

Please consider, TreoCRM will not be compatible with EspoCRM. EspoCRM modules can still be used with TreoCRM, but only after some modifications in code.

### For whom?
TreoCRM is the best fit **for small and medium-sized businesses**, who want to:
* organize lead generation and 
* optimize and automate lead qualification
* improve customer acquisition
* improve communication with existing customers
* organize any other data and processes, which have to do with your (potential) customers, regardless directly or indirectly.

### Modules for TreoCRM
The following modules are available for TreoCRM:
* Two-Level Navigation
* Advanced E-Mail Synchronization
* Checklist Field Type
* Chrome Extension for working with LinkedIn and XING
* Duplicate & Link Contacts
* Invoicing
* Project Management
* Gitlab CRM Connector
* Data Import Feeds
* Data Export Feeds
* Lead Miner
* Lead Qualifications
* EspoCRM Microsoft Outlook Connector for Exchange Server
* EspoCRM Microsoft Outlook Connector for Office 365 and Exchange Online
* EspoCRM Multichannel Communication
* Product Information Management (with a lot of extensions).

Please contact us, if you want to get any of them. Please consider these all are paid modules.

### Features on board
TreCRM has all features needed for a modern CRM system:
* **Sales automation** - leads, opportunities, companies, contacts
* **Customer support** - tasks, case management, email-to-case, knowledge base, customer portals
* **Marketing automation** - campaigns, target lists, email marketing
* **Multiple dashboards** - with many drag-and-drop widgets 
* **Productivity and collaboration** - calendar, meetings, calls, notifications, followings,
* **Emails** - personal and shared accounts,
* **Activity stream and notices** - notes with attachments, change log "who what when"
* TreoCRM comes also with **all features of TreoCore**, which can be found [here](https://github.com/treolabs/treocore).

### What are the advantages of using it?
* Many out-of-the-box features
* Free - 100% open source, licensed under GPLv3
* REST API
* Service-oriented architecture (SOA)
* Responsive and user-friendly UI
* Configurable (entities, relations, layouts, labels, navigation, dashboards)
* Extensible with modules
* as well as [all advantages of TreoCore](https://github.com/treolabs/treocore).

### What technologies is it based on?
TreoCRM was created based on EspoCRM. It uses:
* PHP7 - pure PHP, without any frameworks to achieve the best possible performance
* backbone.js - framework for SPA Frontend
* Composer - dependency manager for PHP
* Some libraries from Zend Framework 3
* MySQL 5

### Integrations
TreoCRM has a REST API and can be integrated with any third-party system or channel.

### Documentation
We are working on documentation. The current version is available [here](https://treopim.com/help).

### Requirements

* Unix-based system
* PHP 7.1 or above (with pdo_mysql, openssl, json, zip, gd, mbstring, xml, curl,exif extensions)
* MySQL 5.5.3 or above

See [Server Configuration](https://github.com/treolabs/treocore/blob/master/docs/en/administration/server-configuration.md) article for more information.

### Installation
To create your new TreoCRM application, first make sure you're using PHP 7.1 or above and have [Composer](https://getcomposer.org/) installed. 

1. Create your new project by running:
   ```
   composer create-project treolabs/treocore my-treocrm-project
   ```
2. Make cron handler files executable:
   ```
   chmod +x bin/cron.sh 
   ```
3. Configure crontab:
   ```
   * * * * * cd /var/www/my-treocrm-project; ./bin/cron.sh process-treocrm-1 /usr/bin/php 
   ```
   - **/var/www/my-treocrm-project** - path to project root
   - **process-treocrm-1** - an unique id of process. You should use different process id if you have few TreoPIM projects in one server
   - **/usr/bin/php** - PHP7.1 or above
4. Install TreoCore by following installation wizard in web interface. Just go to http://YOUR_PROJECT/
5. Install TreoCRM module by ModuleManager

### License

TreoCRM is published under the GNU GPLv3 [license](LICENSE.txt).

### Support

- TreoCRM is a developed and supported by [TreoLabs GmbH](https://treolabs.com/)
- Be a part of [our Community](https://community.treolabs.com/)
- To contact us please visit [TreoLabs’ Website](https://treolabs.com/)
