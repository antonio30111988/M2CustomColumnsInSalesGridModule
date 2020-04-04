# M2CustomColumnsInSalesGridModule
Add a custom columns coupon code and discunt amount  in sales order grid display and filtering

Magento 2 module which add coupon code and discount amount columns into Sales Order Grid Listing in Magento 2 backend.


# Features:

- display of columns
- custom formatting of column display value (discount amount made formatted with currency symbol and to be float with precision 3 level)
- filtering of results by coupon code
- searching capability in global search input for grid
- filtering of results by discount amount


# Setup/install module in Magento 2 instance:

1.) Clone the repository:

$ git clone

2.) copy the Antonio88 folder into app/code/ path into your Magento 2 instance

3.) enable module 

$ php bin/magento module:enable Antonio88_CustomColumnsInSalesGrid

4.) Recomple the DI . generates the code according to a merged DI configs application wide 

$ php bin/magento se:di:co



# Briefing:

in Admin UI Component XML sales_order_grid.xml are added configurations for display columns in sales order grid according to Magento 2 default UI component listing rules (various configs for data type, filtering, labels, visibility, etc..). Also added a base config for filtering of the same in filtering area above grid display.

added a Plugin on Order Sales grid data provider which join source table 'sales_order_grid' with a table 'sales_order' where are located our two columns values for: 'coupon_code' and 'discount_amount' . The plugin is used here because of an override of public method and to prevent override conflicts in case if we would go with full override with strategy

- DI XML config in backend: 

1.) added above Plugin declaration 
2.) created a virtual type of our custom resource grid collection and injected as arguments dependency to sales order grid core model and resource model
3.) into collections argument injected our custom grid collection which just extends Magento 2 base sales grid collection (this give us extensibility and any kind of our specific additional modifications can be extended there)

- added a Custom UI Component column which extends a core one. It's used for transforming a display format for discount amount to look like a real price format with current specified. Its another point where we can easily modify format out or inject some external custom data or whatever to be in a sales grid visible

# NOTE: Please check the local results testing in SCREENSHOTS sent in an email. Thanks.
