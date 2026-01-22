<!-- BEGIN: MAIN -->
<div class="py-2 mb-3">
	<div class="alert alert-info"><h3 class="fs-6 my-0">{PHP.L.featuredpagesmarket_market_title}</h3></div>
	<div class="list-group list-group-flush">
	<!-- BEGIN: FEATUREDPRO_ARTICLES_ROW -->
		<div class="list-group-item mb-2 px-0">
			<div class="d-flex flex-column gap-3 align-items-center">
				<!-- IF {FEATUREDPRO_ARTICLES_ROW_LINK_MAIN_IMAGE} -->
				<a data="featuredpages" href="{FEATUREDPRO_ARTICLES_ROW_URL}" class="w-100 w-md-auto">
					<img
						src="{FEATUREDPRO_ARTICLES_ROW_LINK_MAIN_IMAGE}"
						alt="{FEATUREDPRO_ARTICLES_ROW_TITLE}"
						class="img-fluid rounded d-block mx-auto"
						style="object-fit:cover;
							   width:100%;
							   max-height:180px;
							   height:auto;"
					>
				</a>
				<!-- ENDIF -->

				<!-- CONTENT -->
				<div class="flex-grow-1 d-flex flex-column justify-content-center">
					<a data="featuredpages" href="{FEATUREDPRO_ARTICLES_ROW_URL}" class="text-decoration-none">
						<p class="mb-1">
							{FEATUREDPRO_ARTICLES_ROW_TITLE}
						</p>
					</a>

					<div class="mb-1">
						<small class="text-secondary">
							<!-- IF {FEATUREDPRO_ARTICLES_ROW_DESC} -->
								{FEATUREDPRO_ARTICLES_ROW_DESC}
							<!-- ELSE -->
								{FEATUREDPRO_ARTICLES_ROW_TEXT}
							<!-- ENDIF -->
						</small>
					</div>

					<div>
						<small>
							<a href="{FEATUREDPRO_ARTICLES_ROW_CAT_URL}">
								{FEATUREDPRO_ARTICLES_ROW_CAT_TITLE}
							</a>
						</small>
					</div>
				</div>

			</div>
		</div>
	<!-- END: FEATUREDPRO_ARTICLES_ROW -->
	</div>
</div>
<style>
  a[data="featuredpages"] {
    display: block;
    text-decoration: none;
  }
  a[data="featuredpages"]:hover {
    cursor: pointer; 
  }
  a[data="featuredpages"]:hover img {
    transform: scale(1.05);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    filter: brightness(1.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease, filter 0.3s ease;
  }
  a[data="featuredpages"] img {
    transition: transform 1.3s ease, box-shadow 0.3s ease, filter 0.3s ease;
  }
  a[data="featuredpages"]:hover p {
    transform: scale(1.09);

    filter: brightness(1.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease, filter 0.3s ease;

  }
  a[data="featuredpages"] p {
    transition: transform 1.3s ease, box-shadow 1.3s ease, filter 0.3s ease;

  }
</style>
<!-- END: MAIN -->
