require 'csv'
require 'rubygems'
require 'mongo'

@performances=[]
def performances
	@performances
end

n=0
CSV.foreach("../data/performance.tsv",{:col_sep=>"\t", :headers=>true, :return_headers => true, :header_converters => :symbol, :converters => :all}) do |row|
	performance = Hash[row.headers[0..-1].zip(row.fields[0..-1])]
	unless performance[:actor]==nil or performance[:film]!=nil then
		performances << {:actor => performance[:actor] , :film => performance[:film]}
		puts n
		n+=1
	end
end

# database code can go here
File.open('performances', 'w') {|f| f.write(performances) }