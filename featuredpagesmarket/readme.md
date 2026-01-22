`market.edit.tpl`

```
<!-- IF {PHP|cot_plugin_active('featuredpagesmarket')} -->
<!-- IF {PHP|cot_auth('plug', 'featuredpagesmarket', 'W')} -->
{FEATUREDPRO_ARTICLES_EDIT}
<!-- ENDIF -->
<!-- ENDIF -->
```

`market.tpl`

```
<!-- IF {PHP|cot_plugin_active('featuredpagesmarket')} AND {FEATUREDPRO_ARTICLES_TRUE} -->
{FEATUREDPRO_ARTICLES_PAGES}
<!-- ENDIF -->	
```