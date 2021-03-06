<?php

#
#
# G3N1US - Laravel USDA Nutrition Data
#
# (c) Sean Bethel
# http://bewarerobots.com
#
# For the full license information, view the LICENSE file that was distributed
# with this source code.
#
#
	
	return [
		'usda_endpoint' => 'https://www.ars.usda.gov/ARSUserFiles/80400525/Data/SR/SR28/dnload/sr28asc.zip',
		'table_keys'    => [
			'ABBREV'    => ["NDB_No", "Shrt_Desc", "Water", "Energ_Kcal", "Protein", "Lipid_Tot", "Ash", "Carbohydrt", "Fiber_TD", "Sugar_Tot", "Calcium", "Iron", "Magnesium", "Phosphorus", "Potassium", "Sodium", "Zinc", "Copper", "Manganese", "Selenium", "Vit_C", "Thiamin", "Riboflavin", "Niacin", "Panto_acid", "Vit_B6", "Folate_Tot", "Folic_acid", "Food_Folate", "Folate_DFE", "Choline_Tot", "Vit_B12", "Vit_A_IU", "Vit_A_RAE", "Retinol", "Alpha_Carot", "Beta_Carot", "Beta_Crypt", "Lycopene", "Lut+Zea", "Vit_E", "Vit_D_mcg", "Vit_D_IU", "Vit_K", "FA_Sat", "FA_Mono", "FA_Poly", "Cholestrl", "GmWt_1", "GmWt_Desc1", "GmWt_2", "GmWt_Desc2", "Refuse_Pct"],
			
		],
	];
	